<?php

namespace App\Http\Controllers;

use Auth;
use DB;

use Illuminate\Http\Request;
use App\Post;
use App\Team;
use App\Player;

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
			$teams = Team::all();

			//Parse out teams
			$startPos=0;
			while(($startPos = strpos($post->body, "[team=", $startPos)) !== false){
				$endPos = strpos($post->body, "]", $startPos+5);
				$tagLength = $endPos-$startPos;
				$teamTag = substr($post->body, $startPos+6, $endPos-$startPos-6);
				$team = Team::where('tag', $teamTag)->first();
				$popover = "<img class='flag flag-sm' src='/flags/".$team->country.".png'/> <a href='#' class='tool-tip'>{$team->name}<span>Roster for {$team->name}<br><br>";
				foreach($team->players as $p){
					$popover .= "<img class='flag flag-sm' src='/flags/".$p->country.".png'/> {$p->firstname} \"{$p->handle}\" {$p->lastname}<br>";
				}
				$popover .= "</span></a>";
				$post->body = substr_replace($post->body, $popover, $startPos, $tagLength+1);
				$startPos += $tagLength;
			}

			//Parse out other flags
			$startPos=0;
			while(($startPos = strpos($post->body, "[flag=", $startPos)) !== false){
				$endPos = strpos($post->body, "]", $startPos+5);
				$tagLength = $endPos-$startPos;
				if ($tagLength == 8 || $tagLength == 9){
					$flag = substr($post->body, $startPos+6, $endPos-$startPos-6);
					$img = "<img class='flag flag-sm' src='/flags/".$flag.".png'/>";
					$post->body = substr_replace($post->body, $img, $startPos, $tagLength+1);
				}
				$startPos += $tagLength;
			}

			$post->logView(Auth::check() ? Auth::id() : 0);

			return view('b.s', compact('post', 'fav'));
		}
	}
}
