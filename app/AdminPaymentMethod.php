<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class AdminPaymentMethod extends Model
{
    use Filterable;

    protected $fillable = [
        'payment_type_id',
        'bank_data_id',
        'status_id'
    ];

    private static $whiteListFilter = [
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

    public function bank_data()
    {
        return $this->belongsTo('App\BankData');
    }
}
