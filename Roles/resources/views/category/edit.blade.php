@extends('layouts.app')
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#categoryeditform").validate({
                rules: {
                    cname: {
                        required: true,
                        minlength: 2,
                        maxlength: 20,
                    },
                   
                    active: {
                        required: true,

                    },
               


                },
                messages: {
                    cname: {
                        required: "Name  is required",
                        minlength: "Name must be at least 2 characters",
                        maxlength: "Name cannot be more than 20 characters"
                    },

                    active: {
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



    <form action="{{ route('category.update',$category->id) }}" method="POST" id="categoryeditform">
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