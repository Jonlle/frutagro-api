<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralBanner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section',
        'title',
        'slug',
        'file_image',
        'file_path',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
