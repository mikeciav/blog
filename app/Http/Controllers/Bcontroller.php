<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class Bcontroller extends Controller
{
	public function slug($slug){
		$post=Post::where('slug','=',$slug)->first();
		return view('b.s', compact('post'));
	}
}
