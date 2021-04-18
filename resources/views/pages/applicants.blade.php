@extends('layouts.profile')
@section('content')
<div class="row o-profile-events">
    <x-sidebar type="event"/>
    <div class="col-9">
        {{-- event header  --}}
        <div class="row o-events-header">
            <div class="col-6">
                <h2>Applicants</h2>
            </div>
        </div>
        {{-- sub header PATH  --}}
        <div class="row o-events-sub-header">
            <div class="col-12 m-events-path">
                <a href="{{route('event.profile.events')}}">
                     Events
                </a>
                <span>
                    >
                </span>
                <a href="{{route('event', $event->id)}}">
                    {{$event->name}}
                </a>
                <span>
                    >
                </span>
                <a href="{{(route('event.applicants', $event->id))}}">
                    Applicants
                </a>
            </div>
        </div>

        {{-- applicant cards  --}}

        <div class="row">

            @foreach($event->applicants as $applicant)
                <div class="col-4 o-applicant-card">
                    <div class="m-applicant-card {{$applicant->status === 'rejected' ? 'a-disable' : '' }}">
                        <div class="m-img-container">
                            <img src="{{asset($applicant->user->coverphoto)}}" alt="">
                        </div>
                        <h2>{{$applicant->user->name}}</h2>
                        <h3>{{$applicant->user->city}}</h3>
                        <p>{{$applicant->message}}</p>
                        <a href="{{route('artist', $applicant->user->id)}}" class="a-view" >View</a>
                        <a href="{{route('artist.accept', [$event->id, $applicant->user->id])}}" class="a-accept"  onclick="return confirm('Are you sure?')" >Accept</a>
                        <a href="{{route('artist.reject', [$event->id, $applicant->user->id, $applicant->id])}}" class="a-accept"  onclick="return confirm('Are you sure?')">Reject</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
