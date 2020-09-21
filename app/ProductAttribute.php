<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
