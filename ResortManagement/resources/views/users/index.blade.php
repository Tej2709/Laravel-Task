@extends('layouts.app')

@section('content')
<head>
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>User List</h4>
                    <a href="{{route('resorts.index')}}" class="btn btn-primary">Resorts</a>
                    <a href="{{route('games.index')}}" class="btn btn-warning">Games</a>
                    <a href="{{route('home')}}" class="btn btn-info">Home</a>

                    
                </div>
                <div class="card-body">
                    @if(auth()->user()->usertype=="1")
                    <div class="form-group">
                        <a class="btn btn-success" href="{{ route('users.create')}}">Create New User</a>
                    </div>
                    @endif
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>@sortablelink('id')</th>
                                <th>@sortablelink('name')</th>
                                <th>@sortablelink('email')</th>
                                @if(auth()->user()->usertype=="1")
                                <th width="150px">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @if($data->count())
                            @foreach ($data as $value)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                @if(auth()->user()->usertype=="1")
                                <td>
                                    <form action="{{ route('users.destroy', $value->id)}}" method="post">
                                        <a href="{{route('users.edit', $value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <br>
    {!! $data->appends(\Request::except('page'))->render() !!}

</div>

@endsection