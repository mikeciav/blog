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

			$startPos=0;
			while(($startPos = strpos($post->body, "[flag=", $startPos)) !== false){
				$endPos = strpos($post->body, "]", $startPos+5);
				$tagLength = $endPos-$startPos;
				if ($tagLength == 8 || $tagLength == 9){
					$flag = substr($post->body, $startPos+6, $endPos-$startPos-6);
					$img = "<img class='flag' src='/flags/".$flag.".png'/>";
					$post->body = substr_replace($post->body, $img, $startPos, $tagLength+1);
				}
				$startPos += $tagLength;
			}

			$post->logView(Auth::check() ? Auth::id() : 0);

			return view('b.s', compact('post', 'fav'));
		}
	}
}
