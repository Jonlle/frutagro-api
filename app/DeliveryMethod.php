<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    protected $fillable = [
        'name', 'price', 'description', 'status_id'
    ];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
