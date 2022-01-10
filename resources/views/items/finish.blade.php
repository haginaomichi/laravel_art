@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
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
      {{ $item->description }}
    <div>
      <a href = "{{ route('top') }}">トップに戻る</a>
    </div>
  </div>
@endsection