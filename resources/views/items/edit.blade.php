@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>
  <form method="POST" action="{{ route('items.update', $item) }}">
        @csrf
        @method('patch')
        <div>
            商品名:<input type = "text" name = "name" value="{{ $item->name }}">
        </div>
        <div>
            商品説明:<input type = "text" name = "description" value="{{ $item->description }}">
        </div>
        <div>
            価格:<input type = "text" name = "price" value="{{ $item->price }}">
        </div>
        <div>
            <label>
                カテゴリー:
                <select name="category_id">
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
@endsection