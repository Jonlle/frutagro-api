<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyCode extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'currency_name', 'exchange_rate'
    ];

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
