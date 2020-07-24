<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name', 'slug', 'status_id', 'description'
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
