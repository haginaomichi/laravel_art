@extends('layouts.logged_in')

@section('title', $title)
 
@section('content')
  <div class = "profile_block">
    <h1>{{ $title }}</h1>
    <div class="profile_description">
      @if($user->image !== '')
          <img src="{{ asset('storage/' . $user->image) }}">
      @else
          <img src="{{ asset('images/no_image.png') }}">
      @endif
      <ul>
        <li>名前：{{ $user->name }}さん</li>
        <li>コメント：
          @if($user->profile === '')
            <p>プロフィールが設定されていません。</p>
          @else
            {{ $user->profile }}
          @endif
        </li>
        <li>出展数：{{ $item_count }}</li>
      </ul>
    </div>
    <p class = "image_change"><a href = "{{ route('profile.edit_image', \Auth::user()) }}">画像を変更</a></p>
    <p><a href = "{{ route('profile.edit', \Auth::user()) }}">プロフィール編集</a></p>
    
    <h2>購入履歴</h2>
    @forelse($user->orders as $order)
      <p><a href = "{{ route('items.show', $order->item) }}">{{ $order->item->name }}</a> {{ $order->item->price }}円 出展者：{{ $order->item->user->name }}さん</p>
    @empty
      <p>購入履歴はありません。</p>
    @endforelse
@endsection