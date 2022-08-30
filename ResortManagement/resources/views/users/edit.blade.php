@extends('layouts.app')

<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    
         $(document).ready(function() {
            $("#edituserform").validate({
                rules: {
                    name: {
                        required: true,
                        minlength:4,
                        maxlength: 20,
                    },
                    email:{
                        required: true,
                        email:true,
                        maxlength:30,

                    },

                    password:{
                            required: true,
                            minlength:5,
                            maxlength:20,
                    },
                },

                messages: {
                    name: {
                        required: "Categoryname  is required",
                        minlength:"Categoryname must be at least 4 characters",
                        maxlength: "Name  be more than 20 characters"
                    },

                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                        maxlength: "Email cannot be more than 30 characters",
                    },

                    password: {
                        required: "Password is required",
                        minlength: "Password must be at least 5 characters"
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
                    <h4>Update User

                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('users.update',$user->id) }}" method="POST" id="edituserform">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="Name">Username:</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Please enter name" value="{{$user->name}}">
                        </div>
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <br>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Please enter email address" value="{{$user->email}}" name="email">
                        </div>
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <br>
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