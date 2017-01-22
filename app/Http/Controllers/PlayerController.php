<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Player;

use App\Team;
use App\Post;
use Auth;

class PlayerController extends Controller
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
            $players= Player::orderBy('lastname')->paginate(20);
            $teams = Team::all();
            return view('players.index', compact('players', 'teams'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array('firstname' =>  'required|max:63|',
                                        'lastname' => 'required|max:63',
                                        'handle' => 'required|max:63',
                                        'country' => 'required|max:3'
                                        ));

        $player = new Player;
        foreach(array('firstname', 'lastname', 'handle', 'country') as $v){
            $player->{$v}=$request->{$v};
        }

        $img = explode('/photos/',$request->picture);
        $img = $img[1];
        $player->picture = $img;

        $player->save();

        //Sync teams
        if(!isset($request->teams)) $request->teams = array();
        $player->teams()->sync($request->teams, false);

        return redirect()->route('players.show', $player->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $player = Player::find($id);
        return view('players.show', compact('player'));
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
            $player = Player::find($id);
            $teams = Team::all();
            return view('players.edit', compact('player', 'teams'));
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
        $player = Player::find($id);
        $this->validate($request, array('firstname' =>  'required|max:63|',
                                        'lastname' => 'required|max:63',
                                        'handle' => 'required|max:63',
                                        'country' => 'required|max:3'
                                        ));

        foreach(array('firstname', 'lastname', 'handle', 'country') as $v){
            $player->{$v}=$request->{$v};
        }

        if (strpos($request->picture,'/photos/')){
            $img = explode('/photos/',$request->picture);
            $img = $img[1];
        }
        else{
            $img = $request->picture;
        }
        $player->picture = $img;

        $player->save();

        //Sync teams
        if(!isset($request->teams)) $request->teams = array();
        $player->teams()->sync($request->teams, false);

        return redirect()->route('players.show', $player->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $player=Player::find($id);
        $player->teams()->detach();
        Player::destroy($id);
        return redirect('/');
    }
}
