<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class CurrencyCode extends Model
{
    use Filterable;

    public $incrementing = false;
    public $timestamps = false;

    private static $whiteListFilter = [
        'status_id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'currency_name',
        'currency_symbol',
        'exchange_rate',
        'default',
        'status_id',
    ];

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
