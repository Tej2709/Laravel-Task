@extends('layouts.app')


@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Article</h2>
        </div>
   
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form method="post" action="/articles/{{$article->id}}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="article_name">Article name</label>
        <input type="text" name="name" value="{{ $article->name }}" class="form-control" placeholder="Article name....">
    </div>
    <br>

    <div class="form-group">
        <label for="article_title">Article Title</label>
        <input type="text" name="title" value="{{ $article->title}}" class="form-control" placeholder="Article title...">
    </div>
    <br>

    <div class="form-group">
        <label for="article_description">Article Description</label>
        <input type="text" name="description" value="{{ $article->description }}" class="form-control" class="form-control" placeholder="Article Description...">
    </div>
    <br>

    
    <div class="form-group">
        <label for="Image">Select Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <br>

    <div class="form-group">
        <label for="status">Status</label>
        <input type="radio" name="status" value="active" {{ ($article->status=="active")? "checked" : "" }}>Active
        <input type="radio" name="status" value="inactive" {{ $article->status=="inactive"? "checked" : "" }}>Inactive
    </div>
    <br>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Submit">
        <a class="btn btn-warning" href="{{ route('articles.index') }}"> Back</a>
    </div>

</form>
</div>
@endsection