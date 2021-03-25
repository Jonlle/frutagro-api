<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurService extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icon_name',
        'service_name',
        'description',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
