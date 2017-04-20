<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Team;

use App\Player;
use App\Post;
use Auth;

class TeamController extends Controller
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
            $teams= Team::orderBy('name')->paginate(20);
            $players = Player::all();
            return view('teams.index', compact('teams', 'players'));
        }
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
    public function store(Request $request)
    {
        $this->validate($request, array('name' =>  'required|max:63|',
                                        'tag' => 'required|max:63',
                                        'country' => 'required|max:3'
                                        ));

        $team = new Team;
        foreach(array('name', 'tag', 'country') as $v){
            $team->{$v}=$request->{$v};
        }

        if(!empty($request->logo)){
            $img = explode('/photos/',$request->logo);
            $img = $img[1];
            $team->logo = $img;
        }

        $team->save();

        //Sync teams
        if(!isset($request->players)) $request->players = array();
        $team->players()->sync($request->players, false);

        return redirect()->route('teams.show', $team->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);
        return view('teams.show', compact('team'));
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
            $team = Team::find($id);
            $players = Player::all();
            return view('teams.edit', compact('players', 'team'));
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
        $team = Team::find($id);
        $this->validate($request, array('name' =>  'required|max:63|',
                                        'tag' => 'required|max:63',
                                        'country' => 'required|max:3'
                                        ));

        foreach(array('name', 'tag', 'country') as $v){
            $team->{$v}=$request->{$v};
        }

        if(!empty($request->logo)){
            if (strpos($request->logo,'/photos/')){
                $img = explode('/photos/',$request->logo);
                $img = $img[1];
            }
            else{
                $img = $request->logo;
            }
            $team->logo = $img;
        }

        $team->save();

        //Sync teams
        if(!isset($request->players)) $request->players = array();
        $team->players()->sync($request->players, true);

        return redirect()->route('teams.show', $team->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team=Team::find($id);
        $team->players()->detach();
        Team::destroy($id);
        return redirect('/');
    }
}
