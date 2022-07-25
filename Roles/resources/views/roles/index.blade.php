@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-lg-12" margin-tb>
            <div class="pull-left">
                <h2>Role Management</h2>
            </div>
            <div class="pull-right">
                @can('role-create')
                <a class="btn btn-success" href="{{ route('roles.create') }}">Create New Role</a>
                @endcan
            </div>
        </div>
    </div>
    <br>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            @can('role-edit')
            <th width="180px">Action</th>
            @endcan
        </tr>

        @foreach($roles as $role)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{$role->name}}</td>
            @can('role-edit')
            <td>

                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                @endcan
                @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}


            </td>
            @endcan
        </tr>
        @endforeach
    </table>

</div>
@endsection