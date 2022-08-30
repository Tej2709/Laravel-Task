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
                    <h4>Resort List</h4>
                    <a class="btn btn-primary" href="{{ route('users.index')}}">Users</a>
                    <a class="btn btn-warning" href="{{ route('games.index')}}">Game</a>
                    @if(auth()->user()->usertype=="1")
                    <a class="btn btn-info" href="{{ route('resort.export')}}">Export Data</a>
                    @endif

                </div>
                <div class="card-body">

                    <div class="form-group">
                        @if(auth()->user()->usertype=="1")
                        <a class="btn btn-success" href="{{ route('resorts.create')}}">Create New Resort</a>
                        @endif
                        <br>

                    </div>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="70px">@sortablelink('id')</th>
                                <th>@sortablelink('name')</th>
                                <th>@sortablelink('description')</th>
                                <th>@sortablelink('image')</th>
                                <th>@sortablelink('bigimage')</th>
                                <th width="80px">@sortablelink('status')</th>
                                @if(auth()->user()->usertype=="1")
                                <th width="150px">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if($resort->count())
                            @foreach ($resort as $value)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->description }}</td>
                                <td>
                                    <img src="{{asset('public/images/'. $value->image)}}" width="70px" height="70px" alt="image">
                                </td>
                                <td>
                                    <img src="{{asset('public/image/'. $value->bigimage)}}" width="80px" height="80px" alt="Image">
                                </td>

                                <td>{{$value->status}}</td>
                                @if(auth()->user()->usertype=="1")
                                <td>
                                    <form action="{{ route('resorts.destroy', $value->id)}}" method="post">
                                        <a href="{{route('resorts.edit', $value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this resort?')">Delete</button>
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
    {!! $resort->appends(\Request::except('page'))->render() !!}
</div>


@endsection