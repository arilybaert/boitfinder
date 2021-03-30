@extends('layouts.profile')
@section('content')
<div class="row o-profile-events">
    <x-sidebar type="password"/>

    <form method="POST" action="{{route('event.password.submit')}} " class="col-9">
        @csrf
        <div class="row o-events-header">
            <div class="col-6">
                <h2>Change password</h2>
            </div>
        </div>
        <div class="row o-create-event">
            <div class="col-12" style="text-align: left">
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="col-7">
                <div class="row m-form-group {{ $errors->has('current-password') ? ' has-error' : '' }}">
                    <div class="col-4">
                        <label for="current-password">old password</label>
                    </div>
                    <div class="col-8">
                        <input type="password" name="current-password" required>
                        @if ($errors->has('current-password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('current-password') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="row m-form-group {{ $errors->has('new-password') ? ' has-error' : '' }}">
                    <div class="col-4">
                        <label for="new-password">new password</label>
                    </div>
                    <div class="col-8">
                        <input type="password" name="new-password" required>
                        @if ($errors->has('new-password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('new-password') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="new-password_confirmation">confirmation</label>
                    </div>
                    <div class="col-8">
                        <input type="password" name="new-password_confirmation" id="" required>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="row m-form-group">
                    <div class="col-8 offset-4">
                        <button type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
</form>
</div>

@endsection
