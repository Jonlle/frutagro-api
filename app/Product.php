<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'currency_code_id', 'status_id', 'product_name', 'price', 'discount', 'unit', 'stock_cant', 'sku'
    ];

    public function car_shoppings()
    {
        return $this->hasMany('App\CarShopping');
    }

    public function order_products()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function currency_code()
    {
        return $this->belongsTo('App\CurrencyCode');
    }

    public function suppliers()
    {
        return $this->belongsToMany('App\Supplier')->using('App\ProductSupplier');
    }
}
