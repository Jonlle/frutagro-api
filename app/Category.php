<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'description'
    ];

    public function products()
    {
        return $this->hasMany('App\User');
    }

}
