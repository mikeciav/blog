<?php

namespace App\Http\Controllers;

use Auth;
use DB;

use Illuminate\Http\Request;
use App\Post;

class BController extends Controller
{
	public function slug(Request $request, $slug){
		if(Auth::check()){ //Get favorites if user logged in
            $fav = DB::table('post_user')->whereUserId(Auth::id())->pluck('post_id')->all();
        }

		$query = $request->get("query");
		if($query){
			$posts =Post::search($query)->orderBy('id', 'desc')->paginate(7);
			return view('home', compact('posts', 'fav'));
		}
		else{
			$post=Post::where('slug','=',$slug)->first();
			$post->footer = isset($post->footer) ? nl2br($post->footer) : "";

			$post->logView(Auth::check() ? Auth::id() : 0);

			return view('b.s', compact('post', 'fav'));
		}
	}
}