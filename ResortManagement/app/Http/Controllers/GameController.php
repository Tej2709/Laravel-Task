<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Resort;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\paginate;

class GameController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $data= Game::join('resorts','resorts.id', '=' ,'resorts')->get(['games.*','resorts.name']);
        $games = Game::select('games.*', 'resorts.name as rname')->join('resorts', 'resorts.id', '=', 'resorts')->sortable()->paginate(3);

       
        $rname = Resort::where('status', 'Active')->get('name');
        return view('games.index', compact('games', 'rname'))->with('i', (request()->input('page', 1) - 1) * 3);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = Resort::where('status', 'Active')->get();
        return view('games.create', compact('games'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required|min:10|max:250',
            'status' => 'required',
        ]);



        $games = new Game;

        $games->name = $request->name;

        $games->description = $request->description;

        $games->resorts = $request->resorts;

        $games->status = $request->status;

        $games->save();


        return redirect()->route('games.index')->with('success', 'Games Created Successfully');
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
    public function edit(Game $games, $id)
    {
        $data = Game::find($id);

        $games = Resort::where('status', 'active')->get();

        return view('games.edit', compact('data', 'games'));
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


        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required|min:10|max:250',
        //     'resort' => 'required',
        //     'status' => 'required',
        // ]);



        $games = Game::find($id);

        $games->name = $request->name;


        $games->description = $request->description;

        $games->resorts = $request->resorts;

        $games->status = $request->status;


        $games->update();




        return redirect()->route('games.index')->with('success', 'Games has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $games = Game::find($id);
        $games->delete();
        return redirect()->route('games.index')->with('succes', 'Game Deleted Sucessfully');
    }


 
}
