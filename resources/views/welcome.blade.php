@extends('layouts.auth')

@section('content')

<h1 class="font-weight-light">{{ config('app.name') }}</h1>
<p class="lead">Write down your groceries!</p>
<a href="{{ route('login') }}" class="mx-3 text-dark text-decoration-none">Login</a>
<a href="{{ route('register') }}" class="mx-3 text-dark text-decoration-none">Register</a>

@endsection