<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = [
        'sku',
        'unit_name',
        'unit_cant',
        'price',
        'discount',
        'status_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order', 'order_product')->using(OrderProduct::class)
            ->withPivot([
                'tax_id', 'quantity', 'discount', 'unit'
            ]);
    }
}
