<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'ItemController@index')->name('top');

Route::resource('items', 'ItemController');

// 出品商品一覧
Route::get('/users/{user}/exhibitions', 'ItemController@exhibition')->name('users.exhibition');
// 商品画像の更新
Route::get('/items/{item}/edit_image', 'ItemController@editImage')->name('items.edit_image');
Route::patch('/items/{item}/edit_image', 'ItemController@updateImage')->name('items.update_image');
// 商品詳細
Route::get('/items/{item}', 'ItemController@show')->name('items.show');

// ログイン
Auth::routes();

// ユーザープロフィール
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile', 'ProfileController@update')->name('profile.update');
Route::get('/profile/edit_image', 'ProfileController@editImage')->name('profile.edit_image');
Route::patch('/profile/edit_image', 'ProfileController@updateImage')->name('profile.update_image');
 
Route::resource('users', 'ProfileController')->only([
  'show',
]);

// お気に入り登録
Route::patch('/items/{item}/toggle_like', 'ItemController@toggleLike')->name('items.toggle_like');
// お気に入り一覧
Route::get('/likes', 'LikeController@index')->name('likes.index');

// 購入確認
Route::get('/items/{item}/confirm', 'ItemController@confirm')->name('items.confirm');
// 購入確定
Route::patch('/items/{item}/finish', 'ItemController@finish')->name('items.finish');

