<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new Post</title>
</head>

<body>
    <header>
        <center>
            <h1>Header Section</h1>
        </center>
        {{-- Goto Dashboards --}}
        @if (request()->user->role_id == 1)
            <a href="{{ route('AdminDashboard') }}">Goto Admin Dashboard</a>
        @elseif(request()->user->role_id == 2)
            <a href="{{ route('v-AdminDashboard') }}">Goto Vice Admin Dashboard</a>
        @endif
    </header>
    <hr>
    {{-- ############ ADMIN Form ########## --}}
    @if (request()->user->role_id == 1)
        <center>
            <h1>Admin Dashboard</h1>
            <h2>Create a New Post</h2>
        </center>
        <div>
            <form action="{{ url('post/admin-store') }}" method="POST">
                <table>
                    <tr>
                        <th>
                            @csrf
                            <label for="title">Title</label>
                        </th>
                        <td>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Post Title">
                            @error('title')
                                <small style="color: red; font-size:18px">{{ $message }}</small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="content">Content</label>
                        </th>
                        <td>
                            <textarea class="form-control" id="content" name="content" rows="4" cols="35"
                                placeholder="Write Your Content"></textarea>
                            @error('content')
                                <small style="color: red; font-size:18px">{{ $message }}</small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <button type="submit">Create Post</button>
                        </th>
                    </tr>
                </table>
            </form>
        </div>
    @else
    {{-- ########### Vice ADMIN FOrm ############ --}}
        <center>
            <h1>Vice Admin Dashboard</h1>
            <h2>Create a New Post</h2>
        </center>
        <div>
            <form action="{{ url('post/v_admin-store') }}" method="POST">
                <table>
                    <tr>
                        <th>
                            @csrf
                            <label for="title">Title</label>
                        </th>
                        <td>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Post Title">
                            @error('title')
                                <small style="color: red; font-size:18px">{{ $message }}</small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="content">Content</label>
                        </th>
                        <td>
                            <textarea class="form-control" id="content" name="content" rows="4" cols="35"
                                placeholder="Write Your Content"></textarea>
                            @error('content')
                                <small style="color: red; font-size:18px">{{ $message }}</small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <button type="submit">Create Post</button>
                        </th>
                    </tr>
                </table>
            </form>
        </div>
    @endif
    <hr>
    <footer>
        <center>
            <h1>Footer Section</h1>
        </center>
    </footer>
</body>

</html>
