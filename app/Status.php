<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'description'
    ];

    public function document_types()
    {
        return $this->hasMany('App\DocumentType');
    }

    public function roles()
    {
        return $this->hasMany('App\Role');
    }

    public function permisssions()
    {
        return $this->hasMany('App\Permission');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function user_phones()
    {
        return $this->hasMany('App\UserPhone');
    }

    public function user_emails()
    {
        return $this->hasMany('App\UserEmail');
    }

    public function financial_entities()
    {
        return $this->hasMany('App\FinancialEntity');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
