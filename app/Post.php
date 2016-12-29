<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function logView($user=0){
        DB::table('post_views')->insert(['post_id' => $this->id, 'user_id' => $user]);
    }
}
