<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'estado', 'iso'
    ];

    public function ciudades()
    {
        return $this->hasMany('App\Ciudad');
    }

    public function municipios()
    {
        return $this->hasMany('App\Municipio');
    }

    public function user_addresses()
    {
        return $this->hasMany('App\UserAddress');
    }
}
