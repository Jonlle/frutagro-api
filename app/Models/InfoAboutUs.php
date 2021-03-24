<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class InfoAboutUs extends Model
{
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section',
        'title',
        'info_text',
        'file_image',
        'file_path',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    private static $whiteListFilter = [
        'section'
    ];
}
