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
                    <h4>Games In the Resort</h4>
                </div>
                <div class="card-body">

                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>@sortablelink('id')</th>
                                <th>@sortablelink('name')</th>
                                <th>@sortablelink('description')</th>

                                <th>Status</th>
                                <th width="80x">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($games->count())
                            @foreach ($games as $value)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->description }}</td>

                                <td>{{$value->status}}</td>
                                <td>
                                    <a href="{{route('checkin.index')}}" class="btn btn-warning btn-sm">Play</a>
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
    <a href="{{route('home')}}" class="btn btn-danger btn-sm">Back</a>
    <br>
    <br>
    {!! $games->appends(\Request::except('page'))->render() !!}
</div>

@endsection