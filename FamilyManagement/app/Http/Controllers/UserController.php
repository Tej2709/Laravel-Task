<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Exports\UserExport;
use App\Models\Daily_Works;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

                    // SUPER ADMIN

        if (auth()->user()->usertype == '1') 
        {

            $works = Daily_Works::all();
            $user = User::with('daily_works')->where('usertype', '0')
                ->orwhere('approve', 'false')
                ->orderBy('id', 'desc')
                ->sortable()->paginate(2);
            return view('users.index', compact('user', 'works'))->with('i', (request()->input('page', 1) - 1) * 2);
        } 

        elseif (auth()->user()->usertype == '0') 
        {


            if (auth()->user()->approve == 'false') 
            {
                $works = Daily_Works::all();
                $user = User::with('daily_works')->where('id', auth()->user()->id)
                    ->where('status', 'active')
                    ->orderBy('id', 'desc')
                    ->sortable()->paginate(2);
                return view('users.index', compact('user', 'works'))->with('i', (request()->input('page', 1) - 1) * 2);
            } 

            else 
            {
                $works = Daily_Works::all();
                $user = User::with('daily_works')->where('usertype', '0')
                    ->where('status', 'active')
                    ->orderBy('id', 'desc')
                    ->where('approve', 'true')
                    ->sortable()->paginate(2);
                return view('users.index', compact('user', 'works'))->with('i', (request()->input('page', 1) - 1) * 2);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'email' => 'required',
            'password' => 'required',
            'status' => 'required',
        ]);
        $user = new User;

        $user->name = $request->name;

        $user->email = $request->email;

        $user->password = Hash::make($request->password);

        $user->status = $request->status;

        $user->approve = "false";

        $user->gender = $request->gender;

        $user['photo'] = $request->photo;

        $user->age = $request->age;

        $user->save();


        return redirect()->route('users.index')->with('success', 'User Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = User::where('approve', 'false')->get();
        return view('users.show', compact('user'))->with('i');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $work = Daily_Works::all();
        $user = User::find($id);
        $data = User::find($id);
        $user_works = $data->daily_works->pluck('id')->toArray();
        return view('users.edit', compact('user', 'work', 'user_works'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!empty($request->photo)) {


            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('public/images'), $imageName);
            $user->name = $request->name;
            $user->email = $request->email;

            $user->gender = $request->gender;
            $user->age = $request->age;
            $user->approve = "false";
            $user['photo'] = $imageName;

            $user->updated = "1";
            $user->update();


            $data = $request->work;
            $user->daily_works()->sync($data);

            return redirect()->route('users.index')->with('success', 'Your Profile has been updated successfully');
        } else {
            $user->name = $request->name;
            $user->email = $request->email;

            $user->gender = $request->gender;
            $user->age = $request->age;
            $user->approve = "false";
            $user->update();
            $user->updated = "1";
            $data = $request->work;
            $user->daily_works()->sync($data);
            return redirect()->route('users.index')->with('success', 'Your Profile has been updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }

    // APPROVE FUNCTION FOR APPROVE AND REJECT REQUEST


    public function approve($id)
    {
        $user = User::find($id);
        $user->approve = "true";
        $user->update();
        return redirect()->back();
    }

    public function reject($id)
    {
        $user = User::find($id);
        $user->approve = "false";
        $user->update();
        return redirect()->back();
    }

    // STATUS FUNCTION START HERE FOR ACTIVE AND INACTIVE

    public function active($id)
    {
        $user = User::find($id);
        $user->status = "active";
        $user->update();
        return redirect()->back();
    }

    public function inactive($id)
    {
        $user = User::find($id);
        $user->status = "inactive";
        $user->update();
        return redirect()->route('users.index');
    }
    public function get_user_data()
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }

    public function archive()
    {
        $user = User::onlyTrashed()
            ->orderBy('id', 'desc')->get();
        return view('users.archive', compact('user'));
    }


    public function filterworks(Request $request)
    {
        if (auth()->user()->usertype == '1') {
            $works = Daily_Works::all();
            $filter = $request->filter;

            if (empty($filter)) {
                $works = Daily_Works::all();
                $user = User::with('daily_works')->where('usertype', '0')->sortable()->paginate(2);
            } else {
                $user = User::with('daily_works')->whereHas('daily_works', function ($user) use ($filter) {
                    $user->where('daily__works_id', $filter);
                })->sortable()->paginate(2);
            }
            return view('users.index', compact('user', 'works'))->with('i', (request()->input('page', 1) - 1) * 2);
        }
    }
}
