<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class Order extends Model
{
    use Filterable;

    protected $fillable = [
        'order_number', 'status_id', 'user_id', 'user_address_id', 'payment_id', 'delivery_method_id', 'commentary', 'grand_total', 'item_count'
    ];

    private static $whiteListFilter = [
        'status_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function user_address()
    {
        return $this->belongsTo('App\UserAddress');
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function delivery_method()
    {
        return $this->belongsTo('App\DeliveryMethod');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')
                        ->withPivot([
                            'tax_id', 'quantity', 'discount', 'unit'
                        ]);
    }

}
