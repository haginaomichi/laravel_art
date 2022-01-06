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
              <p>作品名：{{ $item->name }}</p>
              <ul class = "item_body_bottom">
                <li>{{ $item->price }}円</li>
                <li>
                  <button class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</button>
                  <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
                    @csrf
                    @method('patch')
                  </form>
                </li>
              </ul>
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