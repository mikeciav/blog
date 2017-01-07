<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

use Auth;
use DB;

use App\Post;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->get("query");
        if($query){
            $posts =Post::search($query)->orderBy('id', 'desc')->paginate(5);
            return view('home', compact('posts'));
        }
        else {
            $tags= Tag::orderBy('name')->paginate(20);
            return view('tags.index', compact('tags'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //NULL
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array('name' =>  'required|max:63|unique:tags'));

        $tag = new Tag;
        foreach(array('name', 'description') as $v){
            $tag->{$v}=$request->{$v};
        }
        $tag->save();

        return redirect()->route('tags.show', $tag->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::check()){ //Get favorites if user logged in
            $fav = DB::table('post_user')->whereUserId(Auth::id())->pluck('post_id')->all();
        }
        $tag = Tag::find($id);
        return view('tags.show', compact('tag', 'fav'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        $this->validate($request, array('name' =>  'required|max:63|unique:tags'));

        foreach(array('name', 'description') as $v){
            $tag->{$v}=$request->{$v};
        }
        $tag->save();

        return redirect()->route('tags.show', $tag->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->posts()->detach();
        Tag::destroy($id);
        redirect('tags.index');
    }
}
