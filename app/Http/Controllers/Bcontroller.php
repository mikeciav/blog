<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class Bcontroller extends Controller
{
	public function slug(Request $request, $slug){
		$query = $request->get("query");
		if($query){
			$posts =Post::search($query)->orderBy('id', 'desc')->paginate(7);
			return view('home', compact('posts'));
		}
		else{
			$post=Post::where('slug','=',$slug)->first();
			return view('b.s', compact('post'));
		}
	}
}
