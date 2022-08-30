@extends('layouts.app')

<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#resortcreateform").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 4,
                        maxlength: 20,
                    },
                    description: {
                        required: true,

                        maxlength: 250,

                    },

                 
                    status: {
                        required: true,
                    },
                },

                messages: {
                    name: {
                        required: "Categoryname  is required",
                        minlength: "Categoryname must be at least 4 characters",
                        maxlength: "Name  be more than 20 characters"
                    },

                    description: {
                        required: "Description is required",

                        maxlength: "Description cannot be more than 250 characters",
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
        <div class="col-md-12">

            @if (session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Update Resort Information</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('resorts.update',$resort->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="Name">Resort Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Please enter resort name" name="name" value="{{ $resort->name}}">
                        </div>
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <br>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" placeholder="Please enter resort description" " name=" description" value="{{ $resort->description }}">
                        </div>
                        @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <br>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="Smallimage">Small Image</label>
                                <input type="file" name="image" class="form-control" id="image" placeholder="image...">
                            </div>
                            @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <br>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="Bigimage">Big Image</label>
                                <input type="file" name="bigimage" class="form-control" id="bigimage" placeholder="image...">
                            </div>
                            @if ($errors->has('bigimage'))
                            <span class="text-danger">{{ $errors->first('bigimage') }}</span>
                            @endif
                            <br>
                        </div>
                        <br>

                        <div class="form-group">

                            <input type="radio" name="status" value="Active" {{ ($resort->status=="Active")? "checked" : "" }}>Active
                            <input type="radio" name="status" value="Inactive" {{ $resort->status=="Inactive"? "checked" : "" }}>Inactive
                        </div>


                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger float-end">BACK</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection