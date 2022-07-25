@extends('layouts.app')

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



    <form method="post" action="/articles" enctype="multipart/form-data">
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