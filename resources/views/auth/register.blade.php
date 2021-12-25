@extends('layouts.not_logged_in')
 
@section('content')
  <div class = "top">
    <h1>サインイン</h1>
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class = "top_input">
        <label>ユーザー名</label>
        <input type="text" name="name">
        
        <label>メールアドレス</label>
        <input type="email" name="email">
        
        <label>パスワード</label>
        <input type="password" name="password">
  
        <label>パスワード（確認用）</label>
        <input type="password" name="password_confirmation" >
   
        <input class = "button" type="submit" value="登録">
        <p>登録されている方は<a href="{{ route('login') }}">こちら</a></p>
      </div>
    </form>
  </div>
@endsection