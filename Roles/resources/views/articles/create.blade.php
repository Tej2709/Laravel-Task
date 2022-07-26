@extends('layouts.app')

<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#articlecreate").validate({
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

                    image: {
                        required: true,
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
                <h2>Article Create</h2>
            </div>




        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif



    <form method="post" action="/articles" enctype="multipart/form-data" id="articlecreate">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="article_name">Article name</label>
            <input type="text" name="name" class="form-control" id="article_name" placeholder="Article name..." value="{{ old('article_name') }}" required>
        </div>
        <br>
        <div class="form-group">
            <label for="article_title">Article Title</label>
            <input type="text" name="title" placeholder="Article Title..." value="{{ old('article_tag')}}" class="form-control" id="article_title">
        </div>
        <br>

        <div class="form-group">
            <label for="image">Select Image</label>
            <input type="file" name="image" class="form-control-file" id="image">
        </div>
        <br>

        <div class="form-group">
            <label for="content">Insert Content</label>
            <input type="text" id="description" name="description" placeholder="Enter description..." value="{{ old('description')}}" class="form-control">
        </div>
        <br>


        <div class="form-group">
            <label for="staus">Status</label>
            <input type="radio" name="status" value="active" checked>Active
            <input type="radio" name="status" value="inactive">Inactive
        </div>

        <br>
        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Submit">
            <a class="btn btn-warning" href="{{ route('articles.index') }}">Back</a>
        </div>

    </form>
</div>
@endsection