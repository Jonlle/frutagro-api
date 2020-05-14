<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'status_id', 'supplier_name', 'contact_name', 'contact_title', 'address', 'code_postal', 'city', 'country', 'phone', 'fax', 'email'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')->using('App\ProductSupplier');
    }
}
