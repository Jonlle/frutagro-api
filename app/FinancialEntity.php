<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class FinancialEntity extends Model
{
    use Filterable;

    public $timestamps = false;

    protected $fillable = [
        'code', 'entity_name', 'status_id'
    ];

    private static $whiteListFilter = [
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

    public function admin_payment_methods()
    {
        return $this->hasMany('App\AdminPaymentMethod');
    }
}
