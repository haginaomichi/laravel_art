@extends('layouts.not_logged_in')
 
@section('content')
  <div class = "top">
    <h1>ログイン</h1>
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