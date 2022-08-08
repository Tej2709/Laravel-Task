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
                    <h4>User List</h4>
                </div>
                <div class="card-body">

                    <!--FILTER CODE START HERE-->
                    <form method="GET" action="{{route('users.filterworks')}}">
                        <div class="row">
                            <div class="col-lg-12 margin-tb">

                                <div class="pull-right">

                                    @if(auth()->user()->usertype == '1')
                                    <select id="daily_works_filter" name="filter" class="btn btn-info dropdown-toggle class-form-control">
                                        <option value="">All</option>
                                        @foreach($works as $work)
                                        <option value="{{ $work->id}}">{{ $work->works}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit">Filter</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>


                    <!--END OF FILTER CODE-->

                    <div class="form-group">
                        @if(auth()->user()->usertype=="1")
                        <a class="btn btn-success" href="{{ route('users.create')}}">Create New User</a>
                        <a class="btn btn-primary" href="/users/show">Approve Request</a>
                        @endif
                        <a class="btn btn-warning" href="{{ route('users.export')}}">Export Data</a>

                    </div>
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>@sortablelink('name')</th>
                                <th>@sortablelink('email')</th>
                                <th>@sortablelink('photo')</th>
                                <th>@sortablelink('gender')</th>
                                <th>@sortablelink('age')</th>
                                <th>Works</th>

                                @if(auth()->user()->usertype=="1")
                                <th width="100px">@sortablelink('approve')</th>
                                @endif
                                <th width="90px">Action</th>

                                @if(auth()->user()->usertype=="1")
                                <th>@sortablelink('status')</th>
                                <th width="70px">Action</th>
                                @endif


                            </tr>

                        </thead>
                        <tbody id="tbody">

                            @foreach($user as $value)
                            <tr>
                                <td>{{ ++$i}}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td><img src=" {{ asset('public/images/' . $value->photo)}}" width="100" height="80"></td>
                                <td>{{ $value->gender}}</td>
                                <td>{{ $value->age }}</td>
                                <td>
                                    @foreach($value->daily_works as $work)
                                    {{ $work->works}}
                                    <br>

                                    @endforeach
                                </td>

                                @if(auth()->user()->usertype=="1")
                                <td>{{ $value->approve }}</td>
                                @endif


                                <td>
                                    <form action="{{ route('users.reject', $value->id)}}">

                                        @if(auth()->user()->usertype=="0" && auth()->user()->id==$value->id )
                                        <a href="{{route('users.edit', $value->id)}}" class="btn btn-info btn-sm">Edit</a>
                                        @endif

                                        @if(auth()->user()->usertype=="1")
                                        @if($value->approve=="false")
                                        <a href="{{route('users.approve', $value->id)}}" class="btn btn-primary btn-sm">Approve</a>
                                        @else
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to reject ?')">Reject</button>
                                        @endif

                                    </form>
                                </td>
                                @endif

                                @if(auth()->user()->usertype=="1")
                                <td>{{ $value->status }}</td>
                                @endif

                                @if(auth()->user()->usertype=="1")
                                <td>
                                    <form action="{{ route('users.inactive', $value->id)}}">
                                        @if(auth()->user()->usertype=="1")
                                        @if($value->status=="inactive")
                                        <a href="{{route('users.active', $value->id)}}" class="btn btn-primary btn-sm">Active</a>

                                        @else
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to Inactive User ?')">Inactive</button>
                                        @endif
                                        @endif
                                    </form>
                                </td>
                                @endif


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <br>
    {!! $user->appends(\Request::except('page'))->render() !!}

</div>


@endsection