<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogoFavicon extends Model
{
    protected $table = 'logo_favicon';
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'info_name',
        'file_image',
        'file_path',
    ];


}
