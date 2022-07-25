<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function filterProduct(Request $request)
    {
        $query = Product::query();
        $categories = Category::all();
        if ($request->ajax()) {
            if (empty($request->category)) 
            {
                $products = $query->get();
            }

            else
            {
            $products = $query->where(['catid' => $request->category])->get();
            }
            return response()->json($products);
        }
        
    }

    public function index()
    {
 
        $datanew['newdata'] = " ";
        $data1=Category::get('cname');
        $data= Product::join('users','users.id', '=' ,'createby')->get(['products.*','users.email']);
        return view('welcome', compact('data','datanew','data1'))->with('i', (request()->input('page', 1) - 1) * 30);
    }
}
