<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vice Admin Dashboard</title>
</head>

<body>
    <header>
        <center>
            <h1>Header Section</h1>
        </center>
        @if (session('success'))
            <div style="color: green; padding: 5px;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('message '))
            <div style="color: green; padding: 5px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background-color: red; color: white; padding: 5px;">
                {{ session('error') }}
            </div>
        @endif
        <a href="{{ route('logout') }}">Logout</a>
        <hr>
    </header>