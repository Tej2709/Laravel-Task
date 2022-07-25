<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;
use Prophecy\Call\Call;
use Whoops\Run;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $category = Category::latest()->paginate(30);
        $datanew['newdata'] = " ";

        return view('category.index', compact('category', 'datanew'))
            ->with('i', (request()->input('page', 1) - 1) * 30);
    }

    public function show()
    {
    }

    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'cname' => 'required | min:2 | max:15',
            'active' => 'required',

        ], [
            'cname.required' => 'Category name is required',
            'cname.min' => 'Category name should be minimum of 2 characters',
            'cname.max' => 'Category name should be maximum of 15',
            'active.required' => 'Please select active field',
        ]);

        $category = $request->all();
        Category::create($category);

        return redirect()->route('category.index')->with('Success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'cname' => 'required',
            'active' => 'required',
        ], [
            'cname.required' => 'Category Name Required',
            'active.required' => 'Please select active field',
        ]);

        $category->update($request->all());

        return redirect()->route('category.index')->with('success', 'category update successfully');  
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'category deleted successfully'); 
    }
}
