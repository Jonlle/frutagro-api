<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'state_id', 'municipality'
    ];

    public function parishes()
    {
        return $this->hasMany('App\Parish');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
