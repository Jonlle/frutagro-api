<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPhone extends Model
{
    protected $fillable = [
        'phone_number', 'status_id', 'user_id', 'principal'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
