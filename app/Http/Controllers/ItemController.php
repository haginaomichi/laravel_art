<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;
use App\Like;
use App\Order;
use App\Category;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemImageRequest;
use App\Http\Requests\ItemShowRequest;
use App\Services\FileUploadService;
use InterventionImage;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = \Auth::user()->id;
        $items = Item::where('user_id', '!=', $user_id)->latest()->paginate(8);
        
        $keyWord = $request->input('keyWord', '');
        if($keyWord != '') {
            $items = Item::where('name', 'LIKE' , "%{$keyWord}%")->where('user_id', '!=', $user_id)->latest()->paginate(8);
        }
        return view('items.index', [
          'title' => '作品一覧',
          'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \DB::table('categories')->get();
        return view('items.create', [
          'title' => '作品を出展',
          'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $user_id = \Auth::user()->id;
        
        //画像投稿処理
        $path = '';
        $image = $request->file('image');
        // $image_to = '';
        if( isset($image) === true ){
            // $image_name = $image->getClientOriginalName();
            // $image_to = InterventionImage::make($image)->fit(300, 300)->save();
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->store('photos', 'public');
        }
        
        Item::create([
          'user_id' => \Auth::user()->id,
          'name' => $request->name,
          'description' => $request->description,
          'price' => $request->price,
          'category_id' => $request->category_id,
          'image' => $path,
        ]);
        session()->flash('success', '作品を出展しました');
        return redirect()->route('users.exhibition', $user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        $ordered_items = Order::where('item_id', '=', $id)->count();
        return view('items.show', [
          'title' => '作品詳細',
          'item' => $item,
          'ordered_items' => $ordered_items,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = \DB::table('categories')->get();
        return view('items.edit', [
          'title' => '作品情報の編集',
          'item' => $item,
          'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemShowRequest $request, $id)
    {
        $item = Item::find($id);
        $item->update($request->only(['name', 'description', 'price', 'category_id']));
        session()->flash('success', '作品情報を編集しました');
        return redirect()->route('items.show', $item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        
        // 画像の削除
        if($item->image !== ''){
          \Storage::disk('public')->delete($item->image);
        }
        
        $item->delete();
        \Session::flash('success', '作品を削除しました');
        return redirect()->route('items.index');
    }
    
    // 出品商品一覧
    public function exhibition($id){
        $user_id = \Auth::user()->id;
        $items = Item::where('user_id', '=', $user_id)->latest()->paginate(8);
        
        return view('users.exhibition', [
            'title' => '出展作品一覧',
            'items' => $items,
            ]);
    }
    
    // 画像変更画面
      public function editImage($id)
      {
        $item = Item::find($id);
        return view('items.edit_image', [
          'title' => '作品画像の変更',
          'item' => $item,
        ]);
      }
      // 画像変更処理
      public function updateImage($id, ItemImageRequest $request, FileUploadService $service){
        $path = $service->saveImage($request->file('image'));
        $item = Item::find($id);
 
        // 変更前の画像の削除
        if($item->image !== ''){
          // publicディスクから、該当の投稿画像($item->image)を削除
          \Storage::disk('public')->delete(\Storage::url($item->image));
        }
 
        $item->update([
          'image' => $path, 
        ]);
 
        session()->flash('success', '画像を変更しました');
        return redirect()->route('items.show', $item);
      }
    
    // お気に入り登録
    public function toggleLike($id){
          $user = \Auth::user();
          $item = Item::find($id);
 
          if($item->isLikedBy($user)){
              // お気に入りの取り消し
              $item->likes->where('user_id', $user->id)->first()->delete();
              \Session::flash('success', 'お気に入りから取り消しました');
          } else {
              // お気に入りを設定
              Like::create([
                  'user_id' => $user->id,
                  'item_id' => $item->id,
              ]);
              \Session::flash('success', 'お気に入りに追加しました！');
          }
          return redirect('/items');
      }
      
    // 購入確認
    public function confirm($id){
      $item = Item::find($id);
      return view('items.confirm', [
        'title' => '購入確認',
        'item' => $item,
        ]);
    }
    // 購入完了
    public function finish($id){
      $user = \Auth::user();
      $item = Item::find($id);
      
      Order::create([
              'user_id' => $user->id,
              'item_id' => $item->id,
          ]);
      
      return view('items.finish', [
        'title' => 'ご購入ありがとうございます。',
        'item' => $item,
        ]);
    }
}
