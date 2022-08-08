<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = User::sortable()->paginate(2);
        return view('users.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 2);
    }

    public function create()
    {
        return view('users.create');
    }

    public function show()
    {
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:10'
        ]);


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->password = Hash::make($request->password);
        $user->save();


        // User::create($request->all());
        return redirect()->route('users.index')->with('success', 'User Created Successfully');
    }

    public function edit($id)
    {

        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request, [

        //     'name' => 'required',
        //     'email' => 'required|email',
        // ]);


        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->update();

        return redirect()->route('users.index')->with('success', 'User has been updated successfully');
    }

    public function destroy($id)
    {

        $user = User::find($id);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User has been deleted successfully');
    }
}
