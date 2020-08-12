<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'status_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function payment_type()
    {
        return $this->belongsTo('App\PaymentType');
    }

    public function financial_entity()
    {
        return $this->belongsTo('App\FinancialEntity');
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }
}
