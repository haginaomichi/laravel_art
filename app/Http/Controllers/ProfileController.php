<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Item;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileImageRequest;
use App\Services\FileUploadService;

class ProfileController extends Controller
{
    public function edit(){
        $user = \Auth::user();
        return view('profile.edit', [
          'title' => 'プロフィール編集',
          'user'  => $user,
        ]);
    }
    
    public function update(ProfileRequest $request){
        $user = \Auth::user();
        $user->update($request->only(['name', 'profile']));
        session()->flash('success', 'プロフィールを編集しました');
        return redirect()->route('users.show', $user);
    }
    
    public function editImage(){
        $user = \Auth::user();
        return view('profile.edit_image', [
          'title' => 'プロフィール画像編集',
          'user'  => $user
          ]);
    }
    
    public function updateImage(ProfileImageRequest $request, FileUploadService $service){
        //画像投稿処理
        $path = $service->saveImage($request->file('image'));
 
        $user = \Auth::user();
 
        // 変更前の画像の削除
        if($user->image !== ''){
          // publicディスクから、該当の投稿画像($post->image)を削除
          \Storage::disk('public')->delete(\Storage::url($user->image));
        }
 
        $user->update([
          'image' => $path, // ファイル名を保存
        ]);
        
        session()->flash('success', '画像を変更しました');
        return redirect()->route('users.show', $user);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $item_count = Item::where('user_id', '=', $id)->count();
        
        return view('users.show', [
            'title' => 'プロフィール',
            'user' => $user,
            'item_count' => $item_count,
            ]);
    }
}
