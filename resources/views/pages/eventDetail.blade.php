@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 o-event-detail-cover">
        <img src="{{ asset($event->user->coverphoto) }}" alt="" class="a-event-detail-cover">
        <h2>{{$event->user->name}}</h2>
    </div>
</div>
@endsection
