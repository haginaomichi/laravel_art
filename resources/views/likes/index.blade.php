@extends('layouts.logged_in')
 
@section('content')
  <h1>{{ $title }}</h1>
 
  <ul class="posts">
      @forelse($like_items as $item)
          <li class="item">
            <div class="item_content">
              <div class="item_header">
                <a href="{{ route('items.show', $item)}}"><img src="{{ asset('storage/' . $item->image) }}"></a>
                <p>{{ $item->description }}</p>
              </div>
              <div class="item_body">
                <p>商品名：{{ $item->name }} {{ $item->price }}円</p>
                <p>カテゴリ：{{ $item->category->name }} [{{ $item->created_at }}]</p>
              </div>
              <p>{{ $item->isOrderedBy() ? '売り切れ' : '出品中' }}</p>
            </div>
          </li>
      @empty
          <li>商品はありません。</li>
      @endforelse
  </ul>
@endsection