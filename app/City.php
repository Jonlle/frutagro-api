<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'state_id', 'city', 'capital'
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
