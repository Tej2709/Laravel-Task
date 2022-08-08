@extends('layouts.app')

@section('content')
<div class="container">

    <body class="antialiased">


        <table class="table-striped table-bordered">
            <thead class="text-left border-b-2 border-gray-200">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Gender</th>
                    <th>Age</th>
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
                    <td> <a href="{{route('users.approve', $value->id)}}" class="btn btn-primary btn-sm">Approve</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>

</div>
</body>
</div>

@endsection