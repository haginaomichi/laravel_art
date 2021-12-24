@extends('layouts.logged_in')

@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <div class="user_body_main_img">
    @if($user->image !== '')
        <img src="{{ asset('storage/' . $user->image) }}">
    @else
        <img src="{{ asset('images/no_image.png') }}">
    @endif
  <p class = "image_change"><a href = "{{ route('profile.edit_image', \Auth::user()) }}">画像を変更</a></p>
  </div>
  <p>{{ $user->name }}さん</p>
  <p><a href = "{{ route('profile.edit', \Auth::user()) }}">プロフィール編集</a></p>
  
  <h2>プロフィール</h2>
  <div class="user_body_main_comment">
    @if($user->profile === '')
      <p>プロフィールが設定されていません。</p>
    @else
      {{ $user->profile }}
    @endif
  </div>
  <p>出品数：{{ $item_count }}</p>
  
  <h2>購入履歴</h2>
  @forelse($user->orders as $order)
    <p><a href = "{{ route('items.show', $order->item) }}">{{ $order->item->name }}</a> {{ $order->item->price }}円 出品者{{ $order->item->user->name }}さん</p>
  @empty
    <p>購入履歴はありません。</p>
  @endforelse
@endsection