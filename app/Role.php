<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'status_id', 'description'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission')->using('App\PermissionRole');
    }
}
