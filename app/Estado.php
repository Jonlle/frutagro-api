<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'ciudades';
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
}
