<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyCode extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'currency_name', 'currency_symbol', 'exchange_rate'
    ];

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
