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
                </div>
                <div class="card-body">

                    <div class="form-group">
                        @if(auth()->user()->usertype =="1")
                        <a class="btn btn-warning" href="{{ route('users.index')}}">Approved User List</a>
                      
                        @endif

                    </div>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Photo</th>
                                <th>Gender</th>
                                <th>Age</th>
                                @if(auth()->user()->usertype=="1")
                                <th>Approve</th>
                                <th>Status</th>
                                @endif
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach($user as $value)
                            <tr>
                                <td>{{ ++$i}}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td><img src=" {{ asset('public/images/' . $value->photo)}}" width="100" height="80"></td>
                                <td>{{ $value->gender}}</td>
                                <td>{{ $value->age }}</td>
                                @if(auth()->user()->usertype=="1")
                                <td>{{ $value->approve }}</td>
                                @endif

                                @if(auth()->user()->usertype=="1")
                                <td>{{ $value->status }}</td>
                                @endif

                                <td>
                                    <form action="{{ route('users.reject', $value->id)}}" method="get">

                                        @if(auth()->user()->usertype=="0")
                                        <a href="{{route('users.edit', $value->id)}}" class="btn btn-info btn-sm">Edit</a>
                                        @endif

                                        @if(auth()->user()->usertype=="1")
                                        <a href="{{route('users.approve', $value->id)}}" class="btn btn-primary btn-sm">Approve</a>
                                        @csrf
                                        @METHOD('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to reject ?')">Reject</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <br>
  

</div>
@endsection