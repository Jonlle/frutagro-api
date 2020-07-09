<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'estado_id', 'ciudad', 'capital'
    ];

    public function estados()
    {
        return $this->belongsTo('App\Estado');
    }
}
