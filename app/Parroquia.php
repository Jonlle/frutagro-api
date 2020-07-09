<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'municipio_id', 'parroquia'
    ];

    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }
}
