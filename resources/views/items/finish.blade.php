@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
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
      <a href = "{{ route('top') }}">トップに戻る</a>
    </div>
  </div>
@endsection