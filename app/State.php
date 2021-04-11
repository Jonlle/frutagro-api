<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'state', 'iso'
    ];

    public function cities()
    {
        return $this->hasMany('App\City');
    }

    public function municipalities()
    {
        return $this->hasMany('App\Municipality');
    }

    public function user_addresses()
    {
        return $this->hasMany('App\UserAddress');
    }

    public function suppliers()
    {
        return $this->hasMany('App\Supplier');
    }

}
