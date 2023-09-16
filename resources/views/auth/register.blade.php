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
        <h1>Register Page</h1>
    </center>
    <form action="{{ route('registerProcess') }}" method="post">
        @csrf
        <label for="">Name</label>
        <input type="text" name="name" value="">
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
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
</body>

</html>
