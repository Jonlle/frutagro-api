<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    public $timestamps = false;
    public $incrementing = true;

    public function tax()
    {
        return $this->belongsTo('App\Tax');
    }
}
