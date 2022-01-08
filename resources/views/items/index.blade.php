@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <div class="carousel"> <!-- このセレクタを JavaScript で指定する -->
    <div><img src="image01.jpg" alt="画像1"></div>
    <div><img src="image02.jpg" alt="画像2"></div>
    <div><img src="image03.jpg" alt="画像3"></div>
    <div><img src="image04.jpg" alt="画像4"></div>
  </div>
  <ul class="items">
      @forelse($items as $item)
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
            // ここに slick のオプションを指定
            dots: true,
            autoplay: true,
            autoplaySpeed: 3000,
        });
  </script>
@endsection