<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <center>
        <h1>Login Page</h1>
    </center>
    @if (session('success'))
        <div style="background-color: green color: white; padding: 5px;" >
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background-color: red; color: white; padding: 5px;">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->has('email'))
        <div class="error-message" style="color: red;">{{ $errors->first('email') ?? '' }}</div>
    @endif
    @if ($errors->has('password'))
        <div class="error-message" style="color: red;">{{ $errors->first('password') ?? '' }}</div>
    @endif


    <form style="margin-top: 10px" action="{{ route('loginProcess') }}" method="post">
        @csrf
        <label for="">Email</label>
        <input type="email" name="email" value="">
        @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
        <label for="">Password</label>
        <input type="password" name="password" value="">
        @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
        <input type="submit" name="Submit" value="Submit">
    </form>
    <a href="{{ route('registerPage') }}">Register</a>
    <a href="{{route('forgotPassword')}}">Forgot Password ?</a>
</body>

</html>
