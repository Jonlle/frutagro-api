<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class CarouselBanner extends Model
{
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'title_color',
        'description',
        'description_color',
        'file_image',
        'file_path',
        'status_id',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    private static $whiteListFilter = [
        'status_id',
    ];

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
