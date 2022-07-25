<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:article-list|article-create|article-edit|article-delete', ['only' => ['index']]);
        $this->middleware('permission:article-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:article-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:article-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Article::latest()->get();
        return view('articles.index', ['data' => $data])->with('i',($request->input('page',1)-1)*30);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100|unique:articles',
            'title' => 'required|max:100|unique:articles',
            'image' => 'required|image',
            'description' => 'min:50|max:1000',
            'status' => 'required',

        ]);

        $user = auth()->user();
        $articles = new Article;


        if ($request->file('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('public/images/'), $imageName);
            $articles->name = $request->name;
            $articles->title = $request->title;

            $articles->description = $request->description;
            $articles->status = $request->status;
            $articles['image'] = $imageName;
            $articles->save();
            return redirect('articles')->with('success', 'Article saved successfully');
        } else {
            echo "Error creating Product";
        }
    }

    public function show()
    {
    }

    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }


    public function update(Article $article, Request $request)
    {

        $request->validate([
            'name' => 'required|min:2|max:100|',
            'title' => 'required|min:5|max:100|',
            'description' => 'min:50|max:1000',
            'status' => 'required',

        ]);
        if (!empty($request->image)) {

            unlink(public_path('public/images/' . $article->image));
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('public/images'), $imageName);
            $article->name = $request->name;
            $article->title = $request->title;
            $article->image = $request->image;
            $article->description = $request->description;
            $article->status = $request->status;
            // $articles=$request->all();
            // $articles['createdbyuser']=$user->id;
            $article['image'] = $imageName;
            $article->update();
            return redirect('articles')->with('success', 'Product updated successfully ');
        } else {

            $article->name = $request->name;
            $article->title = $request->title;
            $article->description = $request->description;
            $article->status = $request->status;
            // $articles['createdbyuser']=$user->id;
            $article->update();
            return redirect('articles')->with('success', 'Article updated successfully.');
        }
    }

    public function destroy(Article $article)
    {
        unlink(public_path('public/images/'.$article->image));
        $article->delete();
        return redirect('articles')->with('success', 'Article deleted successfully.');
    }
}
