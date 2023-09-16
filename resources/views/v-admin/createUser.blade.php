@include('v-admin.layouts.header')

<center>
    <h1>Vice Admin Dashboard</h1>
    <h2>Create User</h2>
</center>

<a href="{{ route('v-AdminDashboard') }}">Goto Dashboard</a>
<form action="{{ route('storeUser') }}" method="post">
    <table>
        <tr>
            <td>
                @csrf
                <label for="">Name</label>
                <input type="text" name="name" value="">
                @if ($errors->has('name'))
                    <div class="error-message" style="color: red;">{{ $errors->first('name') ?? '' }}</div>
                @endif
            </td>
        </tr>
        <tr>
            <td>
                <label for="">Email</label>
                <input type="email" name="email" value="">
                @if ($errors->has('email'))
                    <div class="error-message" style="color: red;">{{ $errors->first('email') ?? '' }}</div>
                @endif

            </td>
        </tr>
        <tr>
            <td>
                <label for="">Password</label>
                <input type="password" name="password" value="">
                @if ($errors->has('password'))
                    <div class="error-message" style="color: red;">{{ $errors->first('password') ?? '' }}</div>
                @endif

            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="Submit" value="Submit">
            </td>
        </tr>
    </table>
</form>

@include('v-admin.layouts.footer')
