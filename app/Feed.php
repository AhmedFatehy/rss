<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feed extends Model
{
    use Sluggable;
    use SoftDeletes;
    protected $fillable = ['category_id', 'seed_id', 'feed_id', 'url', 'title', 'slug', 'description', 'body', 'publishing_date', 'image', 'author', 'author_link', 'status'];
    protected $dates = ['deleted_at'];


    public function getRouteKeyName() {
        return 'slug';
    }

    public function sluggable()
    {
        return ['slug' => ['source' => 'title']];
    }

    public function seed()
    {
    	return $this->belongsTo('App\Seed');
    }
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
}
