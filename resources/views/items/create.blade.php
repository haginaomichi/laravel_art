@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <div class = "container">
    <div class = "create_block">
      <h1>{{ $title }}</h1>
      <div class = "create_description">
        <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
            @csrf
            <div>
              <label>商品名</label>
              <input class = "item_description" type="text" name="name">
            </div>
            <div>
              <label>商品説明</label>
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
                <!--<label>-->
                <!--  画像を選択:-->
                <!--  <input type="file" name="image">-->
                <!--</label>-->
                <span>
                <input class = "item_image" type="file" name="image" id = "image">
                <label class = "select_image" for = "image" role = "button"><img src = "/images/no_image.png" style = "object-fit: cover;"></label>
                </span>
            </div>
            <input class = "button" type="submit" value="出品">
        </form>
      </div>
    </div>
  </div>
@endsection