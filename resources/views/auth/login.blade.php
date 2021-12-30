@extends('layouts.not_logged_in')
 
@section('content')
  <h1 class = "top_title">Art work</h1>
  <div class = "top">
    <h2>ログイン</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class = "top_input">
          <label>メールアドレス</label>
          <input type="email" name="email">
          
          <label>パスワード</label>
          <input type="password" name="password" >
          
          <input class = "button" type="submit" value="ログイン">
          <p>会員登録がまだの方は<a href="{{ route('register') }}">こちら</a></p>
        </div>
    </form>
  </div>
@endsection