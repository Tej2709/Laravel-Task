<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->where('id','!=', 1)->paginate(5);
        return view('users/index',compact('data'))->with('i',($request->input('page',1)-1)*5);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'name' =>'required',
            'email'=>'required|email|unique:users,email',
            'password' =>'required',
            'roles'=>'required',
            
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
         
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success','User Created Successfully');
    }

    public function show ()
    {
       
    }

    public function edit($id)
    {
        $user =User::find($id);
        $roles =Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit', compact('user', 'roles','userRole'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            //'role'=>'required',
        ]);

        $input = $request->all();

        if(!empty($input['password']))
        {
            $input['password']=Hash::make($input['password']);
        }
        else
        {
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')->with('success','User Updated Successfully');
    }
    

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User Deleted Successfully');
    }


}
