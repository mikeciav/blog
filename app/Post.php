<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function tags(){
    	return $this->belongsToMany('App\Tag');
    }

	public function categories(){
    	return $this->belongsToMany('App\Category');
    }

    public function scopeSearch($query, $search){
    	return $query->where('title', 'LIKE', "%{$search}%");
    }

    public function users(){
    	return $this->belongsToMany('App\User');
    }
}
