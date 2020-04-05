<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'status_id'
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role')->using('App\PermissionRole');
    }
}
