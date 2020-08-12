<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'sku', 'product_name', 'slug', 'stock', 'unit_name', 'unit_cant', 'price', 'discount', 'description', 'file_image', 'file_path', 'tags', 'currency_code_id', 'status_id'
    ];

    public function car_shoppings()
    {
        return $this->hasMany('App\CarShopping');
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

    public function orders()
    {
        return $this->belongsToMany('App\Order')
                        ->withPivot([
                            'tax_id', 'quantity', 'discount', 'unit'
                        ]);
    }

    public function suppliers()
    {
        return $this->belongsToMany('App\Supplier');
    }
}
