<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\User;
use App\Post;

class ProfileController extends Controller
{
	public function profile($id){
		$fav = DB::table('post_user')->whereUserId(Auth::id())->pluck('post_id')->all();

		$user = User::find($id);
		if(Auth::id() != $id)
			return redirect('/');		
		else
			return view('profile', compact('user', 'fav'));
		
	}

	public function favorites(){
		$fav = DB::table('post_user')->whereUserId(Auth::id())->pluck('post_id')->all();
		$id = Auth::id();
		$user = User::find($id);
		if($user->id != Auth::id())
			return redirect('/');
		else
			return view('favorites', compact('user', 'fav'));
	}

	public function store($post_id){
		$post = Post::find($post_id);
		$post->users()->sync([Auth::id()], false);
		return redirect()->back();
	}

	public function destroy($user_id, $post_id){
		$post = Post::find($post_id);
		$post->users()->detach();
		$post->save();
		return redirect()->back();
	}
}
