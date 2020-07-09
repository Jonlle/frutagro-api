<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'estado_id', 'municipio'
    ];

    public function parroquias()
    {
        return $this->hasMany('App\Parroquia');
    }

    public function estado()
    {
        return $this->belongsTo('App\Estado');
    }
}
