<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    public function payment_methods()
    {
        return $this->hasMany('App\PaymentMethod');
    }
}
