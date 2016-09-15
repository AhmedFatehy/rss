<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use SoftDeletes;
    use Sluggable;



    protected $fillable = ['parent_id', 'title', 'slug', 'description', 'status'];
    protected $dates = ['deleted_at'];

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

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function seeds()
    {
    	return $this->hasMany('App\Seed');
    }

    public function feeds()
    {
    	return $this->hasMany('App\Feed');
    }
}
