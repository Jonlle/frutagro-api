<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'description'
    ];

    public function payment_methods()
    {
        return $this->hasMany('App\PaymentMethod');
    }

    public function admin_payment_methods()
    {
        return $this->hasMany('App\AdminPaymentMethod');
    }

    public function bank_data()
    {
        return $this->hasMany('App\BankData');
    }

}
