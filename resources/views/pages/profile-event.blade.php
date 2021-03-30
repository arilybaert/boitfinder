@extends('layouts.profile')
@section('content')

<div class="row o-profile-events">
    <x-sidebar type="event"/>
    <div class="col-9">
        {{-- event header  --}}
        <div class="row o-events-header">
            <div class="col-6">
                <h2>Upcoming events</h2>
            </div>
            <div class="col-6 o-events-header-button">
                <a href="{{route('event.create')}} ">Create new event</a>
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

        {{-- event header  --}}
        <div class="row o-events-header o-events-header__alt">
            <div class="col-6">
                <h2>Completed events</h2>
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
