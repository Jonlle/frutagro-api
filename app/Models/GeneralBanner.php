<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class GeneralBanner extends Model
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
        'slug',
        'file_image',
        'file_path',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    private static $whiteListFilter = [
        'slug'
    ];
}
