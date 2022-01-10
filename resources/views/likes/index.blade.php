@extends('layouts.logged_in')
 
@section('content')
  <h1>{{ $title }}</h1>
 
  <ul class="items">
      @forelse($like_items as $item)
        <li class="item">
          <div class="item_content">
            <div class="item_header">
              <a href="{{ route('items.show', $item)}}"><img src="{{ asset('storage/' . $item->image) }}"></a>
            </div>
            <div class="item_body">
              @if( $item->isOrderedBy() === false)
                <p class = "on_sale">出展中</p>
              @else
                <p class = "sold_out">売切れ</p>
              @endif
              <p>作品名：{{ $item->name }}</p>
              <ul class = "item_body_bottom">
                <li>￥{{ $item->price }}</li>
                @if ( $item->isLikedBy(Auth::user()) === true)
                    <li>
                      <button class = "like_button be_not_like">★</button>
                      <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
                        @csrf
                        @method('patch')
                      </form>
                    </li>
                  @else
                    <li>
                      <button class = "like_button be_like">☆</button>
                      <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
                        @csrf
                        @method('patch')
                      </form>
                    </li>
                  @endif
              </ul>
            </div>
          </div>
        </li>
      @empty
          <li>商品はありません。</li>
      @endforelse
  </ul>
  {{ $like_items->links() }}
  <script>
    /* global $ */
    $('.like_button').on('click', (event) => {
        $(event.currentTarget).next().submit();
    })
  </script>
@endsection