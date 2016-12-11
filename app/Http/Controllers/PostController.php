<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::orderBy('id', 'desc')->paginate(5);
        return view('home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('posts.create', compact('tags'));
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
                                        'body'  =>  'required' 
                                        )
        );

        $post = new Post;
        foreach(array('title', 'slug', 'body') as $v){
            $post->{$v}=$request->{$v};
        }
        $post->save();

        //Sync tags
        $post->tags()->sync($request->tags, false);

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
        $post=Post::find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        
        $tags = Tag::all();

        return view('posts.edit', compact('post', 'tags'));
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
                                        'body'  =>  'required' 
                                        )
        );

        foreach(array('title', 'slug', 'body') as $v){
            $post->{$v}=$request->{$v};
        }
        $post->save();
        
        //Sync tags
        if(isset($request->tags)){
            $post->tags()->sync($request->tags);
        }
        else{
            $post->tags()->sync(array());   
        }

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
        Post::destroy($id);
        return redirect('/');
    }
}
