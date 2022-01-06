@extends('layouts.logged_in')

@section('title', $title)
 
@section('content')
    <h1>{{ $title }}</h1>
    <div class = "edit_block">
        @if($user->image !== '')
            <img src="{{ \Storage::url($user->image) }}">
        @else
            <img src="{{ asset('images/no_image.png') }}">
        @endif
        <form method="POST" action="{{ route('profile.update_image') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div>
                <label>
                    画像を選択:
                    <input type="file" name="image">
                </label>
            </div>
            <input type="submit" value="更新">
        </form>
        <p>[<a href = "{{ route('users.show', \Auth::user()) }}">戻る</a>]</p>
    </div>
@endsection