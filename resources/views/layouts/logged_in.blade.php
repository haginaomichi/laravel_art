@extends('layouts.default')
 
@section('header')
<header>
    <ul class="header_nav">
        <li>
          <a href="{{ route('items.index') }}"><img src = "{{ asset("storage/title_icon.png") }}"></a>
        </li>
        <li>
          <form method = "get" action = "{{route('items.index')}}">
            <input type = "text" name = "keyWord" placeholder = "キーワード検索" value = "@if (isset($search)) {{ $search }} @endif">
            <input type = "submit" value = "検索">
          </form>
        </li>
        <li>
          <a href="{{route('items.create')}}">新規出展</a>
        </li>
        <li><a href = "{{ route('users.show', \Auth::user()->id) }}">マイページ</a>
          <ul>
            <li><a href="{{ route('likes.index') }}">お気に入りリスト</a></li>
            <li><a href = "{{ route('users.exhibition', \Auth::user()->id) }}">出品商品一覧</a></li>
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" value="ログアウト">
              </form>
            </li>
          </ul>
        </li>
    </ul>
    <!--<p>{{ Auth::user()->name }}さん、こんにちは！</p>-->
</header>
@endsection
@section('footer')
<ul class = "footer_nav">
  <li>プライバシーポリシー</li>
  <li>特定商取引に基づく表示</li>
  <li>利用規約</li>
  <li>サイトマップ</li>
</ul>
@endsection