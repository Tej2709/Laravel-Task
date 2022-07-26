@extends('layouts.app')

<head>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#editform").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 20,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50
                    },
                    gender: {
                        required: true,
                    },

                    role:{
                        required: true,
                    },



                },
                messages: {
                    name: {
                        required: "Name  is required",
                        minlength: "Name must be at least 2 characters",
                        maxlength: "Name cannot be more than 20 characters"
                    },

                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                        maxlength: "Email cannot be more than 50 characters",
                    },
                    
                    gender:{
                        required: "Please select a gender",
                    },

                    role:{
                        required: "Please select a role",
                    }

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
                <h2>Edit New User</h2>
            </div>

        </div>
    </div>
    <br>

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id ,'id' =>'editform' ] ]) !!}
    {!! Form::open(array('route' => 'users.store','method'=>'POST','id' => 'admincreateform' )) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>
        <br>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
        </div>
        <br>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Gender:</strong>
                <input type="radio" name="gender" value="male" {{ ($user->gender=="male")? "checked" : "" }}>Male
                <input type="radio" name="gender" value="female" {{ $user->gender=="female"? "checked" : "" }}>Female

            </div>
        </div>
        <br>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
            </div>
        </div>
        <br>
        <br>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary float-left">Submit</button>
            <a class="btn btn-warning" href="{{ route('users.index') }}"> Back</a>
        </div>

    </div>
    {!! Form::close() !!}
</div>
@endsection