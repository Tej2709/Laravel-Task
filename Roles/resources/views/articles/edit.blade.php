@extends('layouts.app')

<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#articleedit").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 20,
                    },


                    title: {
                        required: true,
                        minlength: 5,
                        maxlength: 50,
                    },


                    description: {
                        required: true,
                        minlength: 50,
                        maxlength: 200,
                    },

                    status: {
                        required: true,

                    },



                },
                messages: {
                    name: {
                        required: "Name  is required",
                        minlength: "Name must be at least 2 characters",
                        maxlength: "Name cannot be more than 20 characters"
                    },

                    title: {
                        required: "Title  is required",
                        minlength: "Title must be at least 5 characters",
                        maxlength: "Title cannot be more than 50 characters"
                    },

                    description: {
                        required: "Content   is required",
                        minlength: "Content must be at least 50 characters",
                        maxlength: "Content cannot be more than 200 characters"
                    },

                    status: {
                        required: "Please select Active / Non-Active ",

                    },


                }
            });
        });
    </script>
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
</head>

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


<form method="post" action="/articles/{{$article->id}}" enctype="multipart/form-data" id="articleedit">
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