<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    public $timestamps = false;

    protected $fillable = [
        'state_id', 'city', 'capital'
    ];

    public function states()
    {
        return $this->belongsTo('App\State');
    }

    public function user_addresses()
    {
        return $this->hasMany('App\UserAddress');
    }
}
