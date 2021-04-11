<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class Permission extends Model
{
    use Filterable;

    public $timestamps = false;

    protected $fillable = [
        'name', 'status_id'
    ];

    private static $whiteListFilter = [
        'status_id', 'name'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
