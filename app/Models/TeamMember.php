<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'position',
        'description',
        'file_image',
        'file_path',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
