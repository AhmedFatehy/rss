<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seed extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    use Sluggable;


    protected $fillable = ['category_id', 'title', 'slug', 'url', 'description', 'reload', 'last_reload', 'status'];


    public function getRouteKeyName() {
        return 'slug';
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function feeds()
    {
    	return $this->hasMany('App\Feed');
    }
}
