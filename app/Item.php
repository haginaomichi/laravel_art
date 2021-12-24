<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description', 'category_id', 'price', 'image'
    ];
    //リレーションを設定
    public function category(){
      return $this->belongsTo('App\Category');
    }
    
    public function likes(){
      return $this->hasMany('App\Like');
    }
 
    public function likedUsers(){
      return $this->belongsToMany('App\User', 'likes');
    }
    
    public function isLikedBy($user){
      $liked_users_ids = $this->likedUsers->pluck('id');
      $result = $liked_users_ids->contains($user->id);
      return $result;
    }
    
    // 購入関係
    public function user(){
      return $this->belongsTo('App\User');
    }
    
    public function isOrderedBy(){
      return Order::where('item_id', '=', $this->id)->count()>0;
    }
}
