@extends('layouts.logged_in')
 
@section('content')
  <h1>{{ $title }}</h1>
 
  <ul class="items">
      @forelse($like_items as $item)
        <li class="item">
          <div class="item_content">
            <div class="item_header">
              <a href="{{ route('items.show', $item)}}"><img src="{{ asset('storage/' . $item->image) }}"></a>
              <!--<p>{{ $item->description }}</p>-->
            </div>
            <div class="item_body">
              @if( $item->isOrderedBy() === false)
                <p class = "on_sale">出展中</p>
              @else
                <p class = "sold_out">売切れ</p>
              @endif
              <p>作品名：{{ $item->name }} {{ $item->price }}円</p>
              <!--<p>カテゴリ：{{ $item->category->name }} [{{ $item->created_at }}]</p>-->
              <button class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</button>
              <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
                @csrf
                @method('patch')
              </form>
              <!--<p>{{ $item->isOrderedBy() ? '売り切れ' : '出品中' }}</p>-->
            </div>
          </div>
        </li>
      @empty
          <li>商品はありません。</li>
      @endforelse
  </ul>
  <script>
    /* global $ */
    $('.like_button').on('click', (event) => {
        $(event.currentTarget).next().submit();
    })
  </script>
@endsection