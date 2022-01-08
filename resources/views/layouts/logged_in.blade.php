@extends('layouts.default')
 
@section('header')
<header class = "header_nav">
    <ul class = "header_nav_left">
        <li>
          <a href="{{ route('items.index') }}"><img src = "{{ asset('storage/title_icon.png') }}"></a>
        </li>
    </ul>
    
    <ul class = "header_nav_right">
        <li>
          <form method = "get" action = "{{route('items.index')}}">
            <input type = "text" name = "keyWord" placeholder = "キーワード検索" value = "@if (isset($search)) {{ $search }} @endif">
            <input type = "submit" value = "検索">
          </form>
        </li>
        <li class="hamburger" id="hamburger">
        	<span class="ham_line ham_line1"></span>
        	<span class="ham_line ham_line2"></span>
        	<span class="ham_line ham_line3"></span>
        </li>
        <li>
          <nav class = "globalMenuSp">
            <ul>
              <li><a href = "{{ route('users.show', \Auth::user()->id) }}">マイページ</a></li>
              <li><a href="{{ route('likes.index') }}">お気に入りリスト</a></li>
              <li><a href="{{route('items.create')}}">新規出展</a></li>
              <li><a href = "{{ route('users.exhibition', \Auth::user()->id) }}">出品商品一覧</a></li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <input type="submit" value="ログアウト">
                </form>
              </li>
            </ul>
          </nav>
        </li>
    </ul>
    
    <!--<p>{{ Auth::user()->name }}さん、こんにちは！</p>-->
</header>
<script>
  // const ham = document.getElementById('ham');
  // const menu_wrapper = document.getElementById('menu_wrapper');
  // ham.addEventListener('click', function() {
  // 	ham.classList.toggle('clicked');
  // 	menu_wrapper.classList.toggle('clicked');
  // });
  $(function() {
    $('.hamburger').click(function() {
        $(this).toggleClass('active');
 
        if ($(this).hasClass('active')) {
            $('.globalMenuSp').addClass('active');
        } else {
            $('.globalMenuSp').removeClass('active');
        }
    });
});
</script>
@endsection