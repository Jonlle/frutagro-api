<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'phone',
        'mobile',
        'email',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
