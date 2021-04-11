<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class Product extends Model
{
    use Filterable;

    protected $fillable = [
        'category_id', 'product_name', 'slug', 'discount', 'description', 'file_image', 'file_path', 'tags', 'currency_code_id', 'status_id'
    ];

    private static $whiteListFilter = [
        'id', 'status_id', 'category_id', 'slug'
    ];

    public function car_shoppings()
    {
        return $this->hasMany('App\CarShopping');
    }

    public function product_attributes()
    {
        return $this->hasMany('App\ProductAttribute');
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
