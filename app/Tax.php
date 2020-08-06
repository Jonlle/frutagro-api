<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    // protected $primaryKey = 'tax_id';
    public function order_products()
    {
        return $this->hasMany('App\OrderProduct');
    }
}
