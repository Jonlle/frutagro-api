<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class InformationText extends Model
{
    use Filterable;

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

    private static $whiteListFilter = [
        'status_id', 'section_name'
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
