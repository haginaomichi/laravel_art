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
                <p>{{ $item->description }}</p>
              </div>
              <div class="item_body">
                <p>商品名：{{ $item->name }} {{ $item->price }}円</p>
                <p>カテゴリ：{{ $item->category->name }} [{{ $item->created_at }}]</p>
                <p>{{ $item->isOrderedBy() ? '売り切れ' : '出品中' }}</p>
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
@endsection