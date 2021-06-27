<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'status_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function payment_method()
    {
        return $this->hasOne('App\PaymentMethod');
    }
}
