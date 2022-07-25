@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-info" href="{{ route('products.create') }}">Create New Product</a>
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
        <tr>
            <th>No</th>
            <th>Product</th>
            <th>Category</th>
            <th>Image</th>
            <th>Created By</th>
            <th>Active</th>
            @can('product-edit')
            <th width="180px">Action</th>
            @endcan
        </tr>

        @foreach($data as $key => $value)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $value->pname }}</td>
            <td>{{ $value->catid }}</td>
            <td><img src=" {{ asset('public/images/' . $value->image)}}" width="100" height="80"></td>
            <td>{{ $value->email}}</td>
            <td>{{ $value->active}}</td>
            @can('product-edit')
            <td>
                <form action="{{ route('products.destroy',$value->id) }}" method="POST">
                    
                    <a class="btn btn-primary" href="{{ route('products.edit',$value->id) }}">Edit</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                   
                </form>
            </td>
            @endcan
        </tr>
        @endforeach
    </table>
</div>
@endsection