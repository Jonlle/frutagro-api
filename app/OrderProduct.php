<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Model
{
    public $timestamps = false;

    public function tax()
    {
        return $this->belongsTo('App\Tax');
    }
}
