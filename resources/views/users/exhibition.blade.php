@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <ul class="items">
      @forelse($items as $item)
          <li class="item">
            <div class="item_content">
              <div class="item_header">
                <a href="{{ route('items.show', $item->id)}}"><img src="{{ asset('storage/' . $item->image) }}"></a>
              </div>
              <div class="item_body">
                @if( $item->isOrderedBy() === false)
                  <p class = "on_sale">出展中</p>
                @else
                  <p class = "sold_out">売切れ</p>
                @endif
                <p>商品名：{{ $item->name }} ￥{{ $item->price }}</p>
                <p>カテゴリ：{{ $item->category->name }}</p>
                 <p>{{ $item->description }}</p>
                <p>[{{ $item->created_at }}]</p>
                [<a href="{{ route('items.edit', $item) }}">編集</a>]
                [<a href="{{ route('items.edit_image', $item) }}">画像を変更</a>]
                <form class="delete" method="post" action="{{ route('items.destroy', $item) }}">
                  @csrf
                  @method('DELETE')
                  <input type="submit" value="削除">
                </form>
              </div>
            </div>
          </li>
      @empty
          <li>出品している商品はありません。</li>
      @endforelse
  </ul>
  {{ $items->links() }}
@endsection