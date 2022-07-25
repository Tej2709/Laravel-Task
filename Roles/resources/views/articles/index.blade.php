@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Article's</h2>
            </div>
            <div class="pull-right">
                @can('article-create')
                <a class="btn btn-info" href="{{ route('articles.create') }}">Create New Article</a>
                @endcan
            </div>
            <br>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Article Name</th>
                <th>Article Title</th>
                <th>Image</th>
                <th>Content</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $key => $value)
            <tr>
                <td>{{ ++$i}}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->title }}</td>
                <td><img src=" {{ asset('public/images/' . $value->image)}}" width="100" height="80"></td>
                <td>{{Str::limit($value->description, 20)}}</td>
                <td>{{ $value->status}}</td>
                <td>
                    <form action="{{ route('articles.destroy',$value->id)}}" method="POST">
                        @can('article-edit')
                        <a class="btn btn-primary" href="{{ route('articles.edit',$value->id) }}">Edit</a>
                        @endcan

                        @csrf
                        @method('DELETE')
                        @can('article-delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection