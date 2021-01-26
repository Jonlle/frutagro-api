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

    public function payment_methods()
    {
        return $this->hasMany('App\PaymentMethod');
    }

    public function bank_data()
    {
        return $this->hasMany('App\BankData');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
