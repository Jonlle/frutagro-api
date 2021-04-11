<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'status_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function payment_methods()
    {
        return $this->hasMany('App\PaymentMethod');
    }

    public function order()
    {
        return $this->hasMany('App\Order');
    }
}
