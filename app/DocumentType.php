<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'status_id', 'description'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function suppliers()
    {
        return $this->hasMany('App\Supplier');
    }

    public function admin_payment_methods()
    {
        return $this->hasMany('App\AdminPaymentMethod');
    }

    public function bank_data()
    {
        return $this->hasMany('App\BankData');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

}
