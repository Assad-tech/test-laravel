@include('admin.layouts.header')
<center>
    <h1>Admin Dashboard</h1>
    <h2>Create new User</h2>
</center>
<a href="{{ route('AdminDashboard') }}">Goto Dashboard</a>
<form action="{{ route('storeUserProcess') }}" method="post">
    <table>
        <tr>
            <td>
                @csrf
                <label for="">Name</label>
                <input type="text" name="name" value="">
                @error('name')
                    <small style="color: red; font-size:18px">{{ $message }}</small>
                @enderror
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Email</label>
                <input type="email" name="email" value="">
                @error('email')
                    <small style="color: red; font-size:18px">{{ $message }}</small>
                @enderror
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Password</label>
                <input type="password" name="password" value="">
                @error('password')
                    <small style="color: red; font-size:18px">{{ $message }}</small>
                @enderror
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="Submit" value="Submit">
            </td>
        </tr>
    </table>
</form>

@include('admin.layouts.footer')
