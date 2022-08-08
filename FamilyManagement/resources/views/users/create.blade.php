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
                        minlength: 4,
                        maxlength: 20,
                    },
                    email: {
                        required: true,

                    },
                    password: {
                        required: true,
                    },
                    approve: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                },

                messages: {
                    name: {
                        required: "Username  is required",
                        minlength: "Username must be at least 2 characters",
                        maxlength: "username should be not more than 20 characters"
                    },
                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                        maxlength: "Email cannot be more than 50 characters",
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
                    <h4>Create New User</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" id="usercreateform">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="Name">User Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Please entername" name="name" value="{{old('name')}}">
                        </div>
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <br>

                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Please enter email"  name="email" value="{{ old('email') }}">
                        </div>
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <br>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Please enter password"  name="password" value="{{ old('password') }}">
                        </div>
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                        <br>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <br>

                            <input type="radio" name="status" value="active" checked value="{{old('status')}}" id="status">Active
                            <input type="radio" name="status" value="inactive" value="{{old('status')}}" id="status">Inactive
                        </div>

                        <br>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger float-end">BACK</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection