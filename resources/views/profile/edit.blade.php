@extends('layouts.logged_in')

@section('title', $title)
 
@section('content')
    <h1>{{ $title }}</h1>
    <div class = "edit_block">
        <form method = "post" action = "{{ route('profile.update') }}" enctype="multipart/form-data" >
            @csrf
            @method('patch')
            <div>
                名前：<input type = "name" name = "name" value="{{ $user->name }}">
            </div>
            <div>
                <p>プロフィール：</p>
                <textarea name = "profile" cols = 50 rows = 10>{{ $user->profile }}</textarea>
            </div>
            <input type="submit" value="更新">
        </form>
        <p>[<a href = "{{ route('users.show', \Auth::user()) }}">戻る</a>]</p>
    </div>
@endsection