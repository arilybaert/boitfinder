@extends('layouts.app')
@section('content')
<div class="row">
    <form class="col-8 offset-2 o-login" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row m-login-header">
            <h2>
                Login
            </h2>
        </div>
        <div class="row m-form-group">
            <div class="col-4">
                <label for="email">Email</label>
            </div>
            <div class="col-5">
                <input type="email" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="row m-form-group">
            <div class="col-4">
                <label for="password">Password</label>
            </div>
            <div class="col-5">
                <input type="password" name="password" class="@error('email') is-invalid @enderror" value="{{ old('password') }}" required>
            </div>
        </div>
        <div class="row m-form-group">
            <div class="col-5 offset-4">
                @if (Route::has('password.request'))
            <a class="" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            </div>
        @endif
        </div>
        <div class="row m-form-group">
            <div class="col-5 offset-4">
                <button type="submit">Login</button>
            </div>
        </div>
    </form>
</div>

@endsection
