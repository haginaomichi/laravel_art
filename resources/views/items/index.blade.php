@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <div class="carousel">
    <div><img src= "{{ asset('storage/gallery1.png') }}"></div>
    <div><img src= "{{ asset('storage/gallery2.png') }}"></div>
    <div><img src= "{{ asset('storage/gallery3.png') }}"></div>
    <div><img src= "{{ asset('storage/gallery4.png') }}"></div>
  </div>
  <ul class="items">
    @forelse($items as $item)
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
  {{ $items->links() }}
  
  <script>
    /* global $ */
    $('.like_button').on('click', (event) => {
      $(event.currentTarget).next().submit();
    })
    // カルーセル
    $('.carousel').slick({
      dots: true,
      autoplay: true,
      autoplaySpeed: 3000,
    });
  </script>
@endsection