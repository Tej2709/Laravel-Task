@extends('layouts.app')

<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#gameseditform").validate({
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

                    resorts: {
                        required: true,
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
                    <h4>Update Game</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('games.update',$data->id) }}" method="POST" enctype="multipart/form-data" id="gameseditform">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="Name">Game Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Please enter game name" name="name" value="{{ $data->name}}">
                        </div>
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <br>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" placeholder="Please enter game description" " name=" description" value="{{ $data->description }}">
                        </div>
                        @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <br>
                        <div class="form-group">
                            <label for="resorts">Resorts:</label>
                            <select class="form-control" name="resorts">
                                <option value="">Select</option>
                                @foreach($games as $key => $value)
                                <option value="{{$value->id}}" {{ $value->id=="$data->resorts"? "selected" : "" }}>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>

                        <div class="form-group">

                            <input type="radio" name="status" value="Active" {{ ($data->status=="Active")? "checked" : "" }}>Active
                            <input type="radio" name="status" value="Inactive" {{ $data->status=="Inactive"? "checked" : "" }}>Inactive
                        </div>
                        <br>


                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('games.index') }}" class="btn btn-danger float-end">BACK</a>
                        </div>
                     

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection