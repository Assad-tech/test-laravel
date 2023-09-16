@extends('user.layouts.main')

@section('main-body')
    <center>
        <h2>User Dashboard </h2>
    </center>
    <p>
        @php
            $user = request()->user;
        @endphp
        <h2>
            {{ $user->name }}
        </h2>
    </p>
@endsection