<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{   

    public function getFeaturedAttribute($featured){

        return asset($featured);
    }

    use SoftDeletes;


    protected $dates = ['deleted_at'];


    public function category(){
        
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        
        return $this->belongsToMany('App\Tag');
    }
}
