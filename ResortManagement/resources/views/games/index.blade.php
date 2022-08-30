@extends('layouts.app')

@section('content')

<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Games List</h4>
                    <a class="btn btn-primary" href="{{ route('users.index')}}">Users</a>
                    <a class="btn btn-warning" href="{{ route('resorts.index')}}">Resorts</a>


                </div>
                <div class="card-body">
                    <select name="filter" id="filter">
                        <option value="">Select Resort</option>
                        @foreach($rname as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>

                    <div class="form-group">
                        @if(auth()->user()->usertype=="1")
                        <a class="btn btn-success" href="{{ route('games.create')}}">Create New Game</a>
                        @endif
                        <br>

                    </div>




                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="100px">@sortablelink('id')</th>
                                <th width="100px">@sortablelink('name')</th>
                                <th>@sortablelink('description')</th>

                                <th width="150px">@sortablelink('resorts')</th>
                                <th width="80px">@sortablelink('status')</th>
                                @if(auth()->user()->usertype=="1")
                                <th width="150px">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if($games->count())
                            @foreach ($games as $value)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->description }}</td>


                                <td>{{ $value->rname }}</td>
                                <td>{{$value->status}}</td>
                                @if(auth()->user()->usertype=="1")
                                <td>
                                    <form action="{{ route('games.destroy', $value->id)}}" method="post">
                                        <a href="{{route('games.edit', $value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this game?')">Delete</button>
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
    {!! $games->appends(\Request::except('page'))->render() !!}
</div>




@endsection