@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h2>商品名</h2>
  {{ $item->name }}
  <h2>画像</h2>
  <img src="{{ \Storage::url($item->image) }}">
  <h2>カテゴリー</h2>
  {{ $item->category->name }}
  <h2>価格</h2>
  {{ $item->price }}円
  <h2>説明</h2>
  {{ $item->description }}
  <div>
    @if($ordered_items === 0)
      <a href = "{{ route('items.confirm', $item) }}"><input type="submit" value="購入する"></a>
    @else
      <p>売り切れ</p>
    @endif
  </div>
@endsection