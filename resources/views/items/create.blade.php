@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <div class = "create_block">
    <h1>{{ $title }}</h1>
    <div class = "create_description">
      <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
          @csrf
          <div>
            <label>作品名</label>
            <input class = "item_description" type="text" name="name">
          </div>
          <div>
            <label>作品説明</label>
            <input class = "item_description" type="text" name="description">
          </div>
          <div>
            <label>価格</label>
            <input class = "item_description" type="text" name="price">
          </div>
          <div>
            <label>カテゴリー</label>
            <select class = "item_description" name="category_id">
              <option hidden>選択してください</option>
              @foreach($categories as $category)
                  <option value = "{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <div>
              <label>
                画像を選択:
                <input type="file" name="image">
              </label>
          </div>
          <input class = "button" type="submit" value="出品">
      </form>
    </div>
  </div>
@endsection