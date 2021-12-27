@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <ul class="items">
      @forelse($items as $item)
          <li class="item">
            <div class="item_content">
              <div class="item_header">
                <a href="{{ route('items.show', $item)}}"><img src="{{ asset('../storage/' . $item->image) }}"></a>
                <!--<p>{{ $item->description }}</p>-->
              </div>
              <div class="item_body">
                <p>商品名：{{ $item->name }} {{ $item->price }}円</p>
                <!--<p>カテゴリ：{{ $item->category->name }} [{{ $item->created_at }}]</p>-->
                <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
                <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
                  @csrf
                  @method('patch')
                </form>
                <p>{{ $item->isOrderedBy() ? '売り切れ' : '出品中' }}</p>
              </div>
            </div>
          </li>
      @empty
          <li>商品はありません。</li>
      @endforelse
  </ul>
  {{ $items->links() }}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    /* global $ */
    $('.like_button').on('click', (event) => {
        $(event.currentTarget).next().submit();
    })
  </script>
@endsection