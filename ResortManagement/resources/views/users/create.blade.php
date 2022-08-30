@extends('layouts.app')
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    
         $(document).ready(function() {
            $("#usercreateform").validate({
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

    <form action="{{ route('users.store')}}" enctype="multipart/form-data" method="Post" id="usercreateform">
        @csrf
        @method('POST')
        <!--Html Input for name-->

        <div class="form-group">
            <label for="Name">Username:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Please enter name" value="{{old('name')}}">
        </div>
        @if ($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
        <br>
        <!--Html Input for email-->

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Please enter email address" value="{{old('email')}}" name="email">
        </div>
        @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
        <br>

        <!--Html Input for password-->

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Please enter password" value="{{old('password')}}">
        </div>
        @if ($errors->has('password'))
        <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
        <br>

        <button type="submit" class="btn btn-primary">Create</button>
        <a class="btn btn-danger" href="{{route('users.index')}}">Back</a>
    </form>


</div>




@endsection