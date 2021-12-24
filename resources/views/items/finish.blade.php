@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>商品名</h2>
  {{ $item->name }}
  <h2>画像</h2>
  <img src="{{ \Storage::url($item->image) }}">
  <h2>カテゴリー</h2>
  {{ $item->category->name }}
  <h2>価格</h2>
  {{ $item->price }}
  <h2>説明</h2>
  {{ $item->description }}
  <div>
    <a href = "{{ route('top') }}">トップに戻る</a>
  </div>
@endsection