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
                </div>
                <div class="card-body">
                    @if(auth()->user()->usertype=='1')
                    <a class="btn btn-primary" href="{{ route('resorts.index') }}">Users</a>
                    <a class="btn btn-info" href="{{ route('users.index') }}">Resorts</a>
                    <a class="btn btn-warning" href="{{ route('games.index') }}">Games</a>

                    @endif
                    <br>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="80px">@sortablelink('id')</th>
                                <th width="120px">@sortablelink('name')</th>
                                <th>@sortablelink('description')</th>
                                <th>@sortablelink('image')</th>
                                <th width="100px">@sortablelink('bigimage')</th>
                                <th width="80px">@sortablelink('Status')</th>
                                <th width="150px">Check In</th>
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
                                    <img src="{{asset('public/image/'. $value->bigimage)}}" width="70px" height="70px" alt="Image">
                                </td>
                                <td>{{$value->status}}</td>
                                <td>
                                    <a href="{{route('checkin.show',$value->id)}}" class="btn btn-success btn-sm">Check In</a>
                                </td>
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