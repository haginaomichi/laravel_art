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
      <!--<ul>-->
      <!--  <li>出展者:{{ $item->user->name }}</li>-->
      <!--  <li>カテゴリー:{{ $item->category->name }}</li>-->
      <!--  <li>価格:{{ $item->price }}円</li>-->
      <!--</ul>-->
    </div>
      {{ $item->description }}
    <div>
      <form method="post" class="order" action="{{ route('items.finish', $item) }}">
        @csrf
        @method('patch')
        <a><button class = "button">購入</button></a>
      </form>
    </div>
  </div>
@endsection