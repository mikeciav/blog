<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use Image;
use Session;

use App\Post;

use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::check()){ //Get favorites if user logged in
            $fav = DB::table('post_user')->whereUserId(Auth::id())->pluck('post_id')->all();
        }
        $query = $request->get("query");
        if($query){
            $posts =Post::search($query)->orderBy('id', 'desc')->paginate(7);
        }
        else{
            $posts=Post::orderBy('id', 'desc')->paginate(5);            
        }
        return view('home', compact('posts', 'fav'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user() && Auth::user()->isAdmin()){
            $tags = Tag::all();
            $categories = Category::all();
            return view('posts.create', compact('tags', 'categories'));
        }
        else{
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array('title' =>  'required|max:255',
                                        'slug'  =>  'required|min:3|max:255|unique:posts',
                                        'body'  =>  'required',
                                        'img' => 'required',
                                        'tagline' => 'required|min:10',
                                        )
        );

        $post = new Post;
        foreach(array('title', 'slug', 'body', 'tagline', 'footer') as $v){
            $post->{$v}=$request->{$v};
        }
        $img = explode('/photos/',$request->img);
        $img = $img[1];
        $post->image = $img;

        $post->save();

        //Sync tags
        $post->tags()->sync($request->tags, false);
        $post->categories()->sync($request->categories, false);

        Session::flash('success', 'The post has been published.');
        return redirect()->route('posts.show', $post->id);
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
        $post=Post::find($id);
        $post->footer = isset($post->footer) ? nl2br($post->footer) : "";

        $post->logView(Auth::check() ? Auth::id() : 0);

        return view('posts.show', compact('post', 'fav'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user() && Auth::user()->isAdmin()){
            $post=Post::find($id);

            $tags = Tag::all();
            $categories = Category::all();

            return view('posts.edit', compact('post', 'tags', 'categories'));
        }
        else{
            return redirect('/');
        }
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
        $post=Post::find($id);
        $this->validate($request, array('title' =>  'required|max:255',
                                        'slug'  =>  "required|min:3|max:255|unique:posts,slug, {$id}",
                                        'body'  =>  'required',
                                        'img' => 'required',
                                        'tagline' => 'required|min:10',
                                        )
        );

        foreach(array('title', 'slug', 'body', 'tagline', 'footer') as $v){
            $post->{$v}=$request->{$v};
        }
        if (strpos($request->img,'/photos/')){
            $img = explode('/photos/',$request->img);
            $img = $img[1];
        }
        else{
            $img = $request->img;
        }
        $post->image = $img;

        $post->save();
        
        //Sync tags
        if(isset($request->tags)){
            $post->tags()->sync($request->tags);
        }
        else{
            $post->tags()->sync(array());   
        }

        //Sync categories
        if(isset($request->categories)){
            $post->categories()->sync($request->categories);
        }
        else{
            $post->categories()->sync(array());   
        }

        Session::flash('success', 'The post has been edited.');
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->tags()->detach();
        $post->categories()->detach();
        Post::destroy($id);
        return redirect('/');
    }
}
