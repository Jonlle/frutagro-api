<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionRole extends Pivot
{
    public $timestamps = false;

    protected $fillable = [
        'permission_id', 'role_id'
    ];
}
