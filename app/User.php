<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, Filterable;

    protected $fillable = [
        'username', 'document_type_id', 'role_id', 'status_id', 'name', 'document', 'password', 'avatar'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private static $whiteListFilter = [
        'status_id', 'role_id'
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
