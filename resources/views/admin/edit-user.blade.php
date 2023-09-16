@include('admin.layouts.header')
<center>
    <h1>Edit User</h1>
</center>
<a href="{{route('AdminDashboard')}}">Goto Dashboard</a>
<form action="{{ route('updateUser', ['id' => $user->id]) }}" method="post">
    <table>
        <tr>
            <td>
                @csrf
                <label for="">Update Name</label>
                <input type="text" name="name" value="{{ $user->name }}" id="">
                @error('name')
                    <span class="alert alert-danger" style="color: red">{{ $message }}</span>
                @enderror
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Update Email</label>
                <input type="text" name="email" value="{{ $user->email }}" id="">
                @error('email')
                    <span class="alert alert-danger" style="color: red">{{ $message }}</span>
                @enderror
            </td>
        </tr>
        <tr>
            <td>
                <button type="submit">Update</button>
            </td>
        </tr>
    </table>



</form>

@include('admin.layouts.footer')
