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
}
