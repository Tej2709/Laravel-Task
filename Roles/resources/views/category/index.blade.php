@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Categories</h2>
            </div>
            <br>
            <div class="pull-right">
                @can('category-create')
                <a class="btn btn-info" href="{{ route('category.create') }}">Create New Category</a>
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

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Category</th>
                <th>Active</th>
                @can('category-edit')
                <th width="180px">Action</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach($category as $key => $value)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $value->cname }}</td>
                <td>{{ $value->active }}</td>
                @can('category-edit')
                <td>
                    <form action="{{ route('category.destroy', $value->id) }}" method="POST">
                        
                        <a class="btn btn-primary" href="{{ route('category.edit',$value->id) }}">Edit</a>
                        @endcan

                        @csrf
                        @method('DELETE')
                        @can('category-delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        
                    </form>
                </td>
                @endcan
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
</div>
@endsection