<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class ProductController extends Controller
{
    //

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:product-list|product-create|product-edit|product-delete',['only'=>['index','show']]);
        $this->middleware('permission:product-create',['only' =>['create','store']]);
        $this->middleware('permission:product-edit',['only' =>['edit','update']]);
        $this->middleware('permission:product-delete',['only' =>['destroy']]);
    }

    public function index(Request $request)
    {
        $data= Product::join('users','users.id', '=' ,'createby')->get(['products.*','users.email']);
        return view('products.index',['data' => $data])->with('i',($request->input('page',1)-1)*30);
    }

    public function create()
    {
        $data = Category::where('active', 'yes')->get('cname');
        return view('products.create', compact('data'));
    }

    public function store(Request $request)
    {
        request()->validate([
           // 'name'=>'required',
            'catid'=>'required',
            'image'=>'required',
            'active'=>'required',

        ]);
        
        $user=auth()->user();
        $product= new Product;

        
        if($request->file('image')){
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('public/images'), $imageName);
            $product->pname = $request->pname;
            $product->catid = $request->catid;
            $product->active = $request->active;
            $product['createby']=$user->id;
            $product['image'] =$imageName;
            $product->save();
            return redirect('products')->with('success', 'Product Added Successfully');
        }
    
        else
        {
            return redirect()->route('products.index')->with('Error','Product not created Successfully');
        }
        
    }

    public function show()
    {

    }

    public function edit(Product $product)
    {
        $data= Category::get('cname');
        return view('products.edit',compact('product','data'));
    }

    public function update(Request $request,Product $product)
    {
        if (!empty($request->image)) 
        {

            unlink(public_path('public/images/' . $product->image));
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('public/images'), $imageName);
            $product->pname = $request->pname;
            $product->catid = $request->category;
            $product->active = $request->active;
            // $product=$request->all();
            // $product['createdbyuser']=$user->id;
            $product['image'] = $imageName;
            $product->update();
            return redirect('products')->with('success', 'Product updated successfully ');
        } 
        else 
        {

            $product->pname = $request->pname;
            $product->catid = $request->category;
            $product->active = $request->active;
            // $product['createdbyuser']=$user->id;
            $product->update();
            return redirect('products')->with('success', 'Product updated successfully.');
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
