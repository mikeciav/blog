<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

use Auth;
use DB;

use App\Post;

class CategoryController extends Controller
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
            $posts =Post::search($query)->orderBy('id', 'desc')->paginate(7);
            return view('home', compact('posts'));
        }
        else{
            $categories= Category::orderBy('id')->paginate(20);
            return view('categories.index', compact('categories'));
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
        $this->validate($request, array('name' =>  'required|max:63|unique:categories'));

        $category = new Category;
        foreach(array('name', 'description') as $v){
            $category->{$v}=$request->{$v};
        }
        $category->save();

        return redirect()->route('categories.show', $category->id);
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
        $category = Category::find($id);
        return view('categories.show', compact('category', 'fav'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
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
        $category = Category::find($id);
        $this->validate($request, array('name' =>  'required|max:63|unique:categories'));

        foreach(array('name', 'description') as $v){
            $category->{$v}=$request->{$v};
        }
        $category->save();

        return redirect()->route('categories.show', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->posts()->detach();
        Category::destroy($id);
        redirect('categories.index');
    }
}
