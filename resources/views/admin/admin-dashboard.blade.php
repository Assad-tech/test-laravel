@extends('admin.layouts.main')

@section('main-body')
    @php
        $user = request()->user;
    @endphp
    <center>
        <h2>Admin Dashboard </h2>
    </center>
    <a href="{{ route('addUserPage') }}">Add User</a>
    <a href="{{url('post/admin-index') }}">Go to Posts</a>
    <hr>
    <div>
        <h2>Welcome {{ $user->name }}</h2>
    </div>
    <div>
        <table>
            <tr>
                <th>Role</th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach ($users as $value)
                <tr>
                    <td>{{ $value->role_id }}</td>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->status }}</td>
                    <td><a href="{{ route('editUser', [$value->id]) }}">Edit</a></td>
                    <td><a href="{{ route('deleteUser', [$value->id]) }}">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection