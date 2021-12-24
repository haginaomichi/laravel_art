<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //リレーションを設定
    public function items(){
        return $this->hasMany('App\Item');
    }
}
