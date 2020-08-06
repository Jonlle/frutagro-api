<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'price', 'status_id', 'description'
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
