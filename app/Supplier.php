<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'status_id',
        'supplier_name',
        'contact_name',
        'contact_title',
        'document_type_id',
        'document',
        'postal_code',
        'state_id',
        'city_id',
        'address',
        'phone',
        'fax',
        'email',
    ];

    public function bank_data()
    {
        return $this->hasMany('App\BankData');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function document_type()
    {
        return $this->belongsTo('App\DocumentType');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
