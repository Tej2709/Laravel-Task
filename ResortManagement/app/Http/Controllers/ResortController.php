<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ResortExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Resort;
use Illuminate\Support\Facades\File;
// use Facade\FlareClient\Stacktrace\File;

use function PHPSTORM_META\registerArgumentsSet;

class ResortController extends Controller
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
        $resort = Resort::sortable()->paginate(3);

        return view('resorts.index', compact('resort'))->with('i', (request()->input('page', 1) - 1) * 3);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resorts.create');
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
            'name' => 'required|min:2|max:50',
            'description' => 'required|min:20|max:250',
            'status' => 'required',
        ]);
        $resort = new Resort;
        $resort->name = $request->name;
        $resort->description = $request->description;
        $resort->status = $request->status;

        $imageName = time() . '.' . $request->image->extension();
        $imageName1 = time() . '.' . $request->bigimage->extension();
        $request->image->move(public_path('public/images'), $imageName);

        $request->bigimage->move(public_path('public/image'), $imageName1);
        $resort = $request->all();
        $resort['image'] = $imageName;
        $resort['bigimage'] = $imageName1;
        Resort::create($resort);
        // $resort->save();
        return redirect()->route('resorts.index')->with('success', 'Resort Information Successfully Added');
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
    public function edit($id)
    {
        $resort = Resort::find($id);
        return view('resorts.edit', compact('resort'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resort $resort)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'description' => 'required|min:20|max:250',
            'status' => 'required',
        ]);

        if (!empty($request->image || $request->bigimage)) {


            unlink(public_path('public/images/' . $resort->image));
            unlink(public_path('public/image/' . $resort->bigimage));


            $imageName = time() . '.' . $request->image->extension();
            
            $imageName1 = time() . '.' . $request->bigimage->extension();
       
            $request->image->move(public_path('/public/images'), $imageName);
           
            $request->bigimage->move(public_path('/public/image'), $imageName1);
           
            $resort->name = $request->name;
         
            $resort->description = $request->description;
           
            $resort->status = $request->status;
            $resort['image'] = $imageName;
            $resort['bigimage'] = $imageName1;
        
            $resort->update();
         
            return redirect('resorts')->with('success', 'Resort updated successfully ');
            
        } else {
            $resort->name = $request->name;
            $resort->description = $request->description;
            $resort->status = $request->status;

            $resort->update();
            return redirect('resorts')->with('success', 'Resort updated successfully.');
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
        $resort = Resort::find($id);
        $image = 'public/images/' . $resort->image;
        $image1 = 'public/image/' . $resort->bigimage;

        if (File::exists($image)) {
            File::delete($image1);

            if (File::exists($image)) {
                File::delete($image1);
            }
        }

        $resort->delete();
        return redirect()->route('resorts.index')->with('success', 'Resort Information Deleted Successfully');
    }

    public function get_resort_data()
    {
        return Excel::download(new ResortExport, 'resorts.xlsx');
    }
}
