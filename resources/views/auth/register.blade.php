@extends('layouts.app')
@section('content')
<div class="row">
    <form class="col-8 offset-2 o-login" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="row m-login-header">
            <h2>
                Register
            </h2>
        </div>
        <div class="row m-form-group">
            <div class="col-4">
                <label for="name">Name</label>
            </div>
            <div class="col-5">
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror" required autofocus>
            </div>
        </div>
        <div class="row m-form-group">
            <div class="col-4">
                <label for="email">Email</label>
            </div>
            <div class="col-5">
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
        </div>
        <div class="row m-form-group">
            <div class="col-4">
                <label for="password">{{ __('Password') }}</label>
            </div>

            <div class="col-5">
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row m-form-group">
            <div class="col-4">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
            </div>

            <div class="col-5">
                <input id="password-confirm" type="password" class="" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="row m-form-group">
            <div class="col-4">
                <label for="role">Who are you?</label>
            </div>
            <div class="col-5">
                <div class="o-custom-select">
                    <select name="role" id="role" required="required" class="@error('role') is-invalid @enderror">
                        <option selected disabled>Choose here</option>
                        <option value="artist">Artist</option>
                        <option value="event">Event</option>
                    </select>
                    @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

            </div>
        </div>


        {{-- <div class="row">
            <div class="col-5 offset-4">
                <div class="o-filter-input-checkbox">
                    <label class="container">
                        Artist
                        <input type="radio" name="role" value="artist">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-5 offset-4">
                <div class="o-filter-input-checkbox">
                    <label class="container">
                        Event
                        <input type="radio" name="role" value="event">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div> --}}

        <div class="row m-form-group">
            <div class="col-5 offset-4">
                <button type="submit">Register</button>
            </div>
        </div>
    </form>
</div>
@endsection

