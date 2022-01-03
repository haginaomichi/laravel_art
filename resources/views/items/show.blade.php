@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <div class = "description_block">
    <h2>{{ $item->name }}</h2>
    <div class = "description_body">
      <img src="{{ \Storage::url($item->image) }}">
      <ul>
        <li>出展者:{{ $item->user->name }}</li>
        <li>カテゴリー:{{ $item->category->name }}</li>
        <li>価格:{{ $item->price }}円</li>
      </ul>
    </div>
      {{ $item->description }}
    <div>
      @if($ordered_items === 0)
        <a href = "{{ route('items.confirm', $item) }}"><input class = "button" type="submit" value="購入する"></a>
      @else
        <p>売り切れ</p>
      @endif
    </div>
  </div>
@endsection