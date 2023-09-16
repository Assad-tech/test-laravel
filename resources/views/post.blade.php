<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
</head>

<body>
    <header>

        <center>
            <h1>Header Section</h1>
        </center>
        {{-- Notification Messages --}}
        <div>
            @if (session('success'))
                <div style="color: green; padding: 5px;">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('message'))
                <div style="color: green; padding: 5px;">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div style="background-color: red; color: white; padding: 5px;">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        {{-- Create Post --}}
        @if (request()->user->role_id == 1)
            <a href="{{ url('post/admin-create') }}">Create a Post</a>
        @else
            <a href="{{ url('post/v_admin-create') }}">Create a Post</a>
        @endif
        {{-- Goto Dashboards --}}
        @if (request()->user->role_id == 1)
            <a href="{{ route('AdminDashboard') }}">Goto Admin Dashboard</a>
        @elseif(request()->user->role_id == 2)
            <a href="{{ route('v-AdminDashboard') }}">Goto Vice Admin Dashboard</a>
        @endif
        <a href="{{ route('logout') }}">Logout</a>
    </header>
    <hr>
    @if (request()->user->role_id == 1)
        <center>
            <h1>Admin Dashboard</h1>
            <h2>Post Index</h2>
        </center>
        <table>
            <tr>
                <th>Id</th>
                <th>User Id</th>
                <th>Post Title</th>
                <th>Post Content</th>
                <th colspan="3">Action</th>
            </tr>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->user_id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td><a href="{{ url('post/admin-show', [$post->id]) }}">Show</a></td>
                    <td><a href="{{ url('post/admin-edit', [$post->id]) }}">Edit</a></td>
                    <td><a href="{{ url('post/admin-delete',[$post->id]) }}">Delete</a></td>
                </tr>
            @endforeach
        </table>
    @else
        <center>
            <h1>Vice Admin Dashboard</h1>
            <h2>Post Index</h2>
        </center>
        <table>
            <tr>
                <th>Id</th>
                <th>User Id</th>
                <th>Post Title</th>
                <th>Post Content</th>
                <th colspan="3">Action</th>
            </tr>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->user_id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td><a href="{{ url('post/v_admin-show', [$post->id]) }}">Show</a></td>
                    <td><a href="{{ url('post/v_admin-edit', [$post->id]) }}">Edit</a></td>
                    <td><a href="{{ url('post/v_admin-delete',[$post->id]) }}">Delete</a></td>
                </tr>
            @endforeach
        </table>
    @endif
    <footer>
        <hr>
        <center>
            <h1>Footer Section</h1>
        </center>
    </footer>
</body>

</html>
