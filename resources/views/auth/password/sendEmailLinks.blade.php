<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email The Link</title>
</head>

<body>
    <center>
        <h1>Send a Link to your Email.</h1>
    </center>
    <form action="{{ route('forgotPasswordProcess') }}" method="post">
        @csrf
        <label for="">Enter your Email</label>
        <input type="email" name="email" id="">
        @if ($errors->has('email'))
            <div class="error-message" style="color: red;">{{ $errors->first('email') ?? '' }}</div>
        @endif
        <button type="submit">Send Link</button>
    </form>
</body>

</html>
