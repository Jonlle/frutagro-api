<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialEntity extends Model
{
    public $timestamps = false;

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function payment_methods()
    {
        return $this->hasMany('App\PaymentMethod');
    }

    public function admin_payment_methods()
    {
        return $this->hasMany('App\AdminPaymentMethod');
    }
}
