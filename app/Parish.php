<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'municipality_id', 'parish'
    ];

    public function municipality()
    {
        return $this->belongsTo('App\Municipality');
    }
}
