@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Category</h2>
            </div>
      
            <br>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif



    <form action="{{ route('category.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Category Name:</strong>
                    <input type="text" name="cname" value="{{ $category->cname }}" class="form-control" placeholder="Category">
                </div>
            </div>
            <br>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Active:</strong>
                    <select class="form-control" name="active">
                        <option value="">Select</option>
                        <option value="yes" {{ $category->active=="yes"? "selected" : "" }}>Yes</option>
                        <option value="no" {{ $category->active=="no"? "selected" : "" }}>No</option>
                    </select>
                </div>
            </div>
            <br>

            <br>

            <div class="col-xs-12 col-sm-12 col-md-12 ">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-warning" href="{{ route('category.index') }}"> Back</a>
            </div>
        </div>
    </form>
</div>
</div>
@endsection