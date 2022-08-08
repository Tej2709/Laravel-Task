<?php

use Faker\Guesser\Name;

namespace App;
namespace App\Http\Controllers;

use App\Models\Resort;
use Illuminate\Database\Eloquent\Relations\Concerns\SupportsDefaultModels;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $resort = Resort::where('status', 'active')->sortable()->paginate(3);
    
        return view('home', compact('resort'))->with('i', (request()->input('page', 1) - 1) * 3);
    }

    public function checkin()
    {
    }
}
