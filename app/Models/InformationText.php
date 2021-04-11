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

    /**
     * Scope a query to include only informational texts from the login, register and recover password sections.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAuthSections($query)
    {
        return $query->whereIn('section_name', ['login', 'register', 'recover_password']);
    }

    /**
     * Scope a query to include only informational texts from the mission and vision sections.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMissionVision($query)
    {
        return $query->whereIn('section_name', ['mission', 'vision']);
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
