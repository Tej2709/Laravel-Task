@extends('layouts.app')
@section('content')

<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#edituserform").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 4,
                        maxlength: 20,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 30,

                    },
                    approve: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                    photo: {
                        required: false,
                    },
                    age: {
                        required: true,
                    },
                    gender: {
                        required: true,

                    },
                },


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


<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
            <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Update Your Profile</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('users.update',$user->id) }}" method="POST" id="edituserform" enctype="multipart/form-data">
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


                        <div class="form-group">
                            <label for="photo">Photo:</label>
                            <input type="file" name="photo" id="photo" class="form-control" placeholder="Photo" value="{{$user->photo}}">
                        </div>
                        @if ($errors->has('photo'))
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                        @endif
                        <br>

                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <input type="radio" id="gender" name="gender" value="male" {{ ($user->gender=="male")? "checked" : "" }} checked>Male</label>
                            <input type="radio" id="gender" name="gender" value="female" {{ ($user->gender=="female")? "checked" : "" }}>Female</label>
                        </div>
                        @if ($errors->has('gender'))
                        <span class="text-danger">{{ $errors->first('gender') }}</span>
                        @endif
                        <br>



                        <div class="form-group">
                            <label for="Age">Age:</label>
                            <select class="form-control" required="required" name="age" id="age">
                                <option value="">Select Age</option>
                                <option value="18-30" {{ ($user->age == "18-30")  ? 'selected' : ''}}>18-30</option>
                                <option value="31-40" {{ ($user->age == "31-40" ) ? 'selected' : ''}}>31-40</option>
                                <option value="Above 40" {{ ($user->age == "Above 40")  ? 'selected' : ''}}>Above 40</option>
                            </select>
                        </div>
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <br>


                        <div class="form-group">
                            <label for="checkbox">Works</label>
                            <br>
                            @foreach($work as $value)
                            <input type="checkbox" id="work" name="work[]" value="{{ $value->id }}" {{in_array($value->id,$user_works) ? 'checked' : ''}}>{{$value->works}}</label>
                            <br>
                            @endforeach
                        </div>
                        @if ($errors->has('work'))
                        <span class="text-danger">{{ $errors->first('work') }}</span>
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