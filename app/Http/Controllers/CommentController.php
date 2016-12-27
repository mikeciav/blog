<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

use Session;

use App\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $pid)
    {
        $this->validate($request, array('name' =>  'required|max:255',
                                        'email'  =>  'required|email|max:255',
                                        'comment'  =>  'required|min:5|max:2047'
                                        )
        );

        $comment = new Comment;
        $post = Post::find($pid);
        foreach(array('name', 'email', 'comment') as $v){
            $comment->{$v}=$request->{$v};
        }
        $comment->post()->associate($post);
        $comment->save();

        Session::flash('success', 'Your comment has been posted.');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
