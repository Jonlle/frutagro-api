<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'status_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
