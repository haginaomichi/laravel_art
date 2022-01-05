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
      <dl>
        <dt>名前</dt>
        <dd>{{ $user->name }}さん</dd>
        <dt>コメント</dt>
        <dd>
          @if($user->profile === '')
            <p>プロフィールが設定されていません。</p>
          @else
            {{ $user->profile }}
          @endif
        </dd>
        <dt>出展数</dt>
        <dd>{{ $item_count }}</dd>
      </dl>
    </div>
    <ul class = "profile_change">
      <li>[<a href = "{{ route('profile.edit_image', \Auth::user()) }}">画像を変更</a>]</li>
      <li>[<a href = "{{ route('profile.edit', \Auth::user()) }}">プロフィール編集</a>]</li>
    </ul>
    
    <ul class = "purchase_history">【購入履歴】
      @forelse($user->orders as $order)
        <li><a href = "{{ route('items.show', $order->item) }}">{{ $order->item->name }}</a> {{ $order->item->price }}円 出展者：{{ $order->item->user->name }}さん</li>
      @empty
        <li>購入履歴はありません。</li>
      @endforelse
    </ul>
@endsection