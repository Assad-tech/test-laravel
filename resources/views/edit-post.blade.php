<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
</head>

<body>
    <header>
        <center>
            <h1>Header Section</h1>
        </center>
        <a href="{{ route('logout') }}">Logout</a>
        <hr>
    </header>
    @if (request()->user->role_id == 1)
        <center>
            <h1>Admin Dashboard</h1>
            <h2>Edit a Post</h2>
        </center>
    @elseif (request()->user->role_id == 2)
        <center>
            <h1>Vice Admin Dashboard</h1>
            <h2>Edit a Post</h2>
        </center>
    @endif

    <div>
        {{-- ### Goto Dashboards --}}
        @if (request()->user->role_id == 1)
            <a href="{{ route('AdminDashboard') }}">Go to Dashboard</a>
        @else
            <a href="{{ route('v-AdminDashboard') }}">Go to Dashoard</a>
        @endif
        {{-- #### Goto POsts --}}
        @if (request()->user->role_id == 1)
            <a href="{{ url('post/admin-index') }}">Go to Posts</a>
        @else
            <a href="{{ url('post/v_admin-index') }}">Go to Posts</a>
        @endif
    </div>
    <br>
    @if (request()->user->role_id == 1)
        <form action="{{ url('post/admin-update', [$post->id]) }}" method="POST">
            <table border="1">
                <tr>
                    <th>Post ID</th>
                    <td>
                        @csrf
                        <input type="text" name="id" value="{{ $post->id }}" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Post Title</th>
                    <td>
                        <input type="text" name="title" value="{{ $post->title }}" id="">
                        @if ($errors->has('title'))
                        <div class="error-message" style="color: red;">{{ $errors->first('name') ?? '' }}</div>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Post Conent</th>
                    <td>
                        <textarea name="content" cols="30" rows="10">
                            {{ $post->content }}
                        </textarea>
                        @if ($errors->has('content'))
                        <div class="error-message" style="color: red;">{{ $errors->first('name') ?? '' }}</div>
                    @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">Update Post</button>
                    </td>
                </tr>
            </table>
        </form>
    @else
        <form action="{{ url('post/v_admin-update',[$post->id]) }}" method="POST">
            <table border="1">
                <tr>
                    <th>Post ID</th>
                    <td>
                        @csrf
                        <input type="text" name="id" value="{{ $post->id }}" disabled id="">
                    </td>
                </tr>
                <tr>
                    <th>Post Title</th>
                    <td>
                        <input type="text" name="title" value="{{ $post->title }}" id="">
                        @if ($errors->has('title'))
                        <div class="error-message" style="color: red;">{{ $errors->first('name') ?? '' }}</div>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Post Conent</th>
                    <td>
                        <textarea name="content" id="" cols="30" rows="10">
                            {{ $post->content }}
                        </textarea>
                        @if ($errors->has('content'))
                        <div class="error-message" style="color: red;">{{ $errors->first('name') ?? '' }}</div>
                    @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">Update Post</button>
                    </td>
                </tr>
            </table>
        </form>
    @endif

    <footer>
        <hr>
        <center>
            <h1>Footer Section</h1>
        </center>
    </footer>

</body>

</html>
