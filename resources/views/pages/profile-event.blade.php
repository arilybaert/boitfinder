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
        @foreach ($future_events as $future_event)
            <div class="row o-event">
                <div class="col-2 o-cover-img">
                    <img src="{{ asset($future_event->coverphoto)}} " alt="">
                </div>
                <div class="col-2">
                    <h4>{{$future_event->name}}</h4>
                </div>
                <div class="col-2">
                    <h5>{{date('d-m-Y', strtotime($future_event->date))}}</h5>
                </div>
                <div class="col-2">
                    <h4>{{$future_event->applicants->count()}}</h4>
                </div>
                <div class="col-2">
                    <a href="">Applicants</a>
                </div>
                <div class="col-2">
                    <a href="">Edit</a>
                </div>
            </div>
        @endforeach


        {{-- event header  --}}
        <div class="row o-events-header o-events-header__alt">
            <div class="col-6">
                <h2>Completed events</h2>
            </div>
        </div>

        {{-- upcoming events  --}}
        @foreach ($passed_events as $passed_event)
            <div class="row o-event">
                <div class="col-2 o-cover-img">
                    <img src="{{ asset($passed_event->coverphoto)}} " alt="">
                </div>
                <div class="col-2">
                    <h4>{{$passed_event->name}}</h4>
                </div>
                <div class="col-2">
                    <h5>{{date('d-m-Y', strtotime($passed_event->date))}}</h5>
                </div>
                <div class="col-2">
                    <h4>{{$passed_event->applicants->count()}}</h4>
                </div>
                <div class="col-2">
                    <a href="">Applicants</a>
                </div>
                <div class="col-2">
                    <a href="">Edit</a>
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection
