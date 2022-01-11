@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <div class = "description_block">
    <h2>{{ $item->name }}</h2>
    <div class = "description_body">
      <img src="{{ \Storage::url($item->image) }}">
      <dl class = "description_info">
        <dt>出展者</dt>
        <dd>{{ $item->user->name }}</dd>
        <dt>カテゴリー</dt>
        <dd>{{ $item->category->name }}</dd>
        <dt>価格</dt>
        <dd>{{ $item->price }}円</dd>
      </dl>
    </div>
    <p class = "description_comment">{!! nl2br(e( $item->description)) !!}</p>
    <div>
      @if($ordered_items === 0)
        <a href = "{{ route('items.confirm', $item) }}"><input class = "button" type="submit" value="購入する"></a>
      @else
        <p class = "show_sold_out">売切れ</p>
      @endif
    </div>
  </div>
@endsection