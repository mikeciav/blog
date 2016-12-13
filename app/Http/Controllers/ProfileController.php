<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class ProfileController extends Controller
{
	public function profile($id){
		$user = User::find($id);
		if(Auth::id() != $id)
			return redirect('/');		
		else
			return view('profile', compact('user'));
		
	}

	public function favorites(){
		$user_id = Auth::user()->id;
		$user = User::find($user_id);
		if($user->id != $user_id)
			return redirect('/');
		else
			return view('favorites', compact('user'));
	}

	public function store($id){
		$post = Post::find($id);
		$post->users()->sync([Auth::user()->id], false);
		redirect('/');
	}
}
