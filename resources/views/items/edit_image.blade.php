@extends('layouts.logged_in')
 
@section('content')
  <h1>{{ $title }}</h1>
  <div class = "edit_block">
    <img src="{{ \Storage::url($item->image) }}">
    <form method="POST" action="{{ route('items.update_image', $item) }}" enctype="multipart/form-data">
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
    <p>[<a href = "{{ route('users.exhibition', \Auth::user()->id) }}">戻る</a>]</p>
  </div>
@endsection