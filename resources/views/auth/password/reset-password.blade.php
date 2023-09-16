<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        <h3>
            Hello {{ $user->name }},
        </h3>
        You are receiving this email because a password reset request has been made for your account.
        To reset your password, click the link below:
        @if ($type)
            <h1>Your toke is here: {{ $user->forgot_pass_token }}</h1>
        @else
            {{-- <a href="{{ url('auth/verifyEmail', [$user->forgot_pass_token]) }}">Please Click Link to verify email.</a> --}}
            <a href="{{ route('showRestForm', $user->forgot_pass_token) }}">Click Here!</a>
        @endif

        If you did not request a password reset, no further action is required.

        Thanks,
        {{ config('app.name') }}
    </div>


</body>

</html>
