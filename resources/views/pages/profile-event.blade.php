@extends('layouts.profile')
@section('content')

<div class="row o-profile-events">
    <div class="col-3">
        <h3>Events</h3>
        <h3>Edit profile</h3>
        <h3>Password</h3>
        <h3>Manage Media</h3>
    </div>
    <div class="col-9">
        {{-- event header  --}}
        <div class="row o-events-header">
            <div class="col-6">
                <h2>Upcoming events</h2>
            </div>
            <div class="col-6 o-events-header-button">
                <a href="">Create new event</a>
            </div>
        </div>

        {{-- upcoming events  --}}
        <div class="row o-event">
            <div class="col-2 o-cover-img">
                <img src="{{ asset('src/img/event/cover/cover-0.jpg')}} " alt="">
            </div>
            <div class="col-2">
                <h4>Jazz Night</h4>
            </div>
            <div class="col-2">
                <h5>16/05/2021</h5>
            </div>
            <div class="col-2">
                <h4>2</h4>
            </div>
            <div class="col-2">
                <a href="">Applicants</a>
            </div>
            <div class="col-2">
                <a href="">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection
