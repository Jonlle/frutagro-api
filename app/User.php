<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'username', 'doc_type_id', 'role_id', 'status_id', 'name', 'first_name', 'last_name', 'document', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function user_addresses()
    {
        return $this->hasMany('App\UserAddress');
    }

    public function user_phones()
    {
        return $this->hasMany('App\UserPhone');
    }

    public function user_emails()
    {
        return $this->hasMany('App\UserEmail');
    }

    public function orders()
    {
        return $this->hasMany('App\UserOrder');
    }

    public function car_shoppings()
    {
        return $this->hasMany('App\CarShopping');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function document_type()
    {
        return $this->belongsTo('App\DocumentType');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

}
