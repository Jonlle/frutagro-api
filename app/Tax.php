<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    public $timestamps = false;

    public function order_products()
    {
        return $this->hasMany('App\OrderProduct');
    }
}
