<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>

<body>
    <div style="text-align: center;">
        <h1>Reset Your Password</h1>
        <p>Please enter your new password below:</p>
    </div>

    <form method="POST" action="{{ route('passwordResetProcess', $user) }}">
        @csrf
        <div>
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password">
            @if ($errors->has('password'))
                <div class="error-message" style="color: red;">{{ $errors->first('password') ?? '' }}</div>
            @endif
        </div>

        <div>
            <label for="password_confirmation">Confirm New Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
            @if ($errors->has('password_confirmation'))
                <div class="error-message" style="color: red;">{{ $errors->first('password_confirmation') ?? '' }}</div>
            @endif
        </div>

        <div>
            <button type="submit">Reset Password</button>
        </div>
    </form>
</body>

</html>
