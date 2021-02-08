<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
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

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
