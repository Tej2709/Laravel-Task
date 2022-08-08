<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Resort;

use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filterResort()
    {
        $games = Game::all();
        $resorts = Resort::all();
        dd($resorts);

        return view('games', compact('games', 'resorts'));
    }
}
