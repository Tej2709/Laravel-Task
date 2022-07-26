@extends('layouts.app')
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#productedit").validate({
                rules: {
                    pname: {
                        required: true,
                        minlength: 2,
                        maxlength: 20,
                    },
                    category: {
                        required: true,
                    },
                    active: {
                        required: true,

                    },
               


                },
                messages: {
                    pname: {
                        required: "Name  is required",
                        minlength: "Name must be at least 2 characters",
                        maxlength: "Name cannot be more than 20 characters"
                    },

                    category: {
                        required: "Please select Category",
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
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">

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

    <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data" id="productedit">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="pname" value="{{ $product->pname }}" class="form-control" placeholder="Product">
                </div>
            </div>
            <br>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Category:</strong>
                    <select class="form-control" name="category">
                        <option value="">Select</option>
                        @foreach($data as $key => $value)
                        <option value="{{$value->cname}}" {{ $product->catid=="$value->cname"? "selected" : "" }}>{{$value->cname}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <input type="hidden" name="createby" value="{{Auth::user()->email}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Active:</strong>
                    <select class="form-control" name="active">
                        <option value="">Select</option>
                        <option value="yes" {{ $product->active=="yes"? "selected" : "" }}>Yes</option>
                        <option value="no" {{ $product->active=="no"? "selected" : "" }}>No</option>
                    </select>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Select Image:</strong>
                    <input type="file" name="image" class="form-control">
                    <span class="text-danger" id="imageval"></span>
                </div>
            </div>
            <br>
            <!-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div> -->
            <div class="col-xs-12 col-sm-12 col-md-12 ">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-warning" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </form>
</div>
</div>

@endsection