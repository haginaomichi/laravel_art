@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <div class = "create_block">
    <h1>{{ $title }}</h1>
    <div class = "create_description">
      <form method="POST" action="{{ route('items.update', $item) }}">
          @csrf
          @method('patch')
            <div>
              <label>作品名</label>
              <input class = "item_description" type = "text" name = "name" value="{{ $item->name }}">
            </div>
            <div>
              <label>作品説明</label>
              <textarea name = "description" cols = 50 rows = 5 >{{ $item->description }}</textarea>
            </div>
            <div>
              <label>価格</label>
              <input class = "item_description" type = "text" name = "price" value="{{ $item->price }}">
            </div>
            <div>
              <label>カテゴリー</label>
                <select class = "item_description" name="category_id">
                  @foreach($categories as $category)
                    <option value = "{{ $category->id }}" 
                      @if($item->category_id == $category->id) selected @endif
                      >{{ $category->name }}</option>
                  @endforeach
                </select>
              </label>
            </div>
            <input type="submit" value="更新">
      </form>
      <p>[<a href = "{{ route('users.exhibition', \Auth::user()->id) }}">戻る</a>]</p>
    </div>
  </div>
@endsection