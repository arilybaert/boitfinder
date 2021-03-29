@extends('layouts.app')
@section('content')
<div class="row">
    <form class="col-8 offset-2 o-login" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="row m-login-header">
            <h2>
                Forgot password
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
            <div class="col-5 offset-4">
                <button type="submit">Send password</button>
            </div>
        </div>
    </form>
</div>

@endsection
