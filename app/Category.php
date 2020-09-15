<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class Category extends Model
{
    use Filterable;

    protected $fillable = [
        'category_name', 'slug', 'status_id', 'description'
    ];

    private static $whiteListFilter = [
        'status_id'
    ];

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
