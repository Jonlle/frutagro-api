<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'address_type_id', 'postal_code', 'state_id', 'city_id', 'address', 'reference_point', 'status_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function state()
    {
        return $this->belongsTo('App\Estado');
    }

    public function city()
    {
        return $this->belongsTo('App\Ciudad');
    }
}
