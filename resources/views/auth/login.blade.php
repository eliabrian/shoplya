@extends('layouts.auth')

@section('content')

<h1 class="font-weight-light">{{ config('app.name') }}</h1>
<p class="lead">Sign in to do write your groceries!</p>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-primary" role="alert">
                <h5 class="alert-heading">To demo this application, use the following credentials:</h5>
                <p class="m-0">Email: admin@admin.com</p>
                <p class="m-0">Password: password</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="E-mail address...">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="Password...">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-dark">
                        {{ __('Login') }}
                    </button>
                    <a href="{{ route('register') }}" class="btn btn-outline-dark">
                        {{ __('Register') }}
                    </a>
                </div>
                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection