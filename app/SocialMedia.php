<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class SocialMedia extends Model
{
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'icon_name',
        'icon_size',
        'name',
        'url',
        'status_id'
    ];

    private static $whiteListFilter = [
        'status_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
