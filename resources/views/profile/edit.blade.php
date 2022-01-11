@extends('layouts.logged_in')

@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <div class = "edit_block">
    <form method = "post" action = "{{ route('profile.update') }}" enctype="multipart/form-data" >
      @csrf
      @method('patch')
        <div>
          <label>名前</label>
          <input class = "edit_name" type = "name" name = "name" value="{{ $user->name }}">
        </div>
        <div>
          <label>プロフィール</label>
          <textarea name = "profile" cols = 50 rows = 5>{{ $user->profile }}</textarea>
        </div>
        <input type="submit" value="更新">
    </form>
    <p>[<a href = "{{ route('users.show', \Auth::user()) }}">戻る</a>]</p>
  </div>
@endsection