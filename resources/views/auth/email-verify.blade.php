<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
</head>

<body>
    <center>
        <h1>{{ $user->name }}</h1>
    </center>

    @if ($type)
        <h1>Your toke is here: {{ $user->remember_token }}</h1>
    @else
        <a href="{{ url('auth/verifyEmail', [$user->remember_token]) }}">Please Click Link to verify email.</a>
    @endif

    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima, eum fuga ipsa illo blanditiis laudantium
        excepturi sit placeat esse? Laudantium accusantium doloribus mollitia dignissimos dolores eveniet suscipit
        reprehenderit necessitatibus quidem!</p>
    <p>Thank You</p>
</body>

</html>
