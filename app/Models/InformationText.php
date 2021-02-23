<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationText extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_name',
        'information_text',
        'status_id',
    ];
}
