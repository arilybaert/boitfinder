@extends('layouts.app')
@section('content')

<div class="o-gallery" id="o-gallery">
    <div class="m-gallery" id="m-gallery">
        <h2>Gallery</h2>
        <div class="m-photo" id="m-photo">
            @foreach ($photo_files as $photo_file)
                {{-- uncomment to use db pictures --}}
                @if (env('STORAGE') === 'public')
                    <img src="{{asset($photo_file) }}" alt="gallery picture" class="a-gallery-picture">
                @elseif(env('STORAGE') === 's3')
                    <img src="{{ env('AWS_URL') . $photo_file}}" alt="gallery picture" class="a-gallery-picture">
                @endif
                @endforeach
                <div class="a-left a-image-button" id="a-left">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <div class="a-right a-image-button" id="a-right">
                    <i class="fas fa-arrow-right"></i>
                </div>
        </div>
        <div class="m-gallery-video" id="o-gallery-video">
            <iframe class="a-gallery-video" src="{{env('VIMEO_URL') . $event->user->vimeo_id}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
        </div>
        <i class="fas fa-video a-video" id="a-photo-video-btn"></i>
        <i class="fas fa-camera a-video" id="a-photo-video-btn_photo"></i>
    </div>
</div>

{{-- image --}}
<div class="row">
    <div class="col-10 offset-1 o-event-detail-cover" id="a-gallery-open">

        @if (env('STORAGE') === 'public')
            <img src="{{ asset($event->user->coverphoto) }}" alt="" class="a-event-detail-cover">
        @elseif(env('STORAGE') === 's3')
            <img src="{{ env('AWS_URL') . $event->user->coverphoto}}" alt="" class="a-event-detail-cover">
        @endif
        <h2>{{$event->user->name}}</h2>
        <i class="fas fa-camera"></i>

    </div>
</div>

{{-- event details --}}
<div class="row">
    <div class="col-10 offset-1 m-event-details" id="m-event-details">
        <div class="row">
            <div class="col-10">
                <div class="row">
                    <div class="col-3 col-lg-2 m-event-detail-tags">
                        <i class="fas fa-users a-event-detail-tags-icon"></i>
                        <h4>Capacity</h4>
                        <h5>{{ $event->user->capacity }}</h5>
                    </div>
                    <div class="col-3 col-lg-2 m-event-detail-tags">
                        <i class="fas fa-music a-event-detail-tags-icon"></i>
                        <h4>Genre</h4>
                        <h5>{{ $event->genre->name }}</h5>

                    </div>
                    <div class="col-3 col-lg-2 m-event-detail-tags">
                        <i class="far fa-calendar-alt a-event-detail-tags-icon"></i>
                        <h4>Date</h4>
                        <h5>{{ date("d/m/Y",strtotime($event->date)) }}</h5>

                    </div>
                    <div class="col-3 col-lg-2 m-event-detail-tags">
                        <i class="fas fa-volume-up a-event-detail-tags-icon"></i>
                        <h4>PA</h4>
                        <h5>{{ $event->user->pa->name }}</h5>

                    </div>
                    <div class="col-3 col-lg-2 m-event-detail-tags">
                        <i class="fas fa-microphone a-event-detail-tags-icon"></i>
                        <h4>Microphones</h4>
                        @foreach($event->user->microphones as $microphone)
                            <h5>{{$microphone->microphone->name}}</h5>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- event description and contact information --}}
<div class="row o-event-detail">
    <div class="col-10 offset-1">
        <div class="row">
            {{-- event description  --}}
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <h3>
                            {{ $event->name}}
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p>
                            {{ $event->description}}
                        </p>
                    </div>
                </div>
            </div>
            {{-- event contact information --}}
            <div class="col-4">
                <div class="row">
                    <div class="o-information">
                        <div class="row m-information">
                            <div class="col-2">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="col-9">
                                <h4>
                                    Address
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9 offset-2">
                                {{ $event->user->address}},
                                <br>
                                {{ $event->user->city . ' ' . $event->user->zipcode}}
                            </div>
                        </div>

                        <div class="row m-information">
                            <div class="col-2">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="col-9">
                                <h4>
                                    Telephone
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9 offset-2">
                                {{ $event->user->telephone}}
                            </div>
                        </div>

                        <div class="row m-information">
                            <div class="col-2 m-information-icon">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <div class="col-9">
                                <h4>
                                    Website
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9 offset-2">
                                {{ $event->user->website}}
                            </div>
                        </div>

                    </div>
                </div>


                <div class="row o-apply-button">
                            <button class="a-apply-button" id="a-applyBtn">Apply now</button>
                            <div class="col-3 a-apply-color-1"></div>
                            <div class="col-3 a-apply-color-2"></div>
                            <div class="col-3 a-apply-color-3"></div>
                            <div class="col-3 a-apply-color-4"></div>


                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        {{-- <div class="row">
            <div class="o-media-buttons">
                <div class="m-media-buttons">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
        </div> --}}
    </div>

</div>
<div class="o-apply-form @if (\Session::has('success')) a-display @endif" id="o-apply-form">
    <div class="row m-apply-form">
        <div class="col-6 offset-3">


            <form action="{{route('event.apply')}}" method="POST" id="o-form">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <h2>Apply now</h2>
                    </div>
                </div>

                {{-- check if user is logged in --}}
                @if (!Auth::check())
                    <div class="m-apply-form-warning">
                        <p>You need to be logged in to apply for an event!</p>
                    </div>
                @else
                    @if (Auth::user()->role === 'event')
                    <div class="m-apply-form-warning">
                        <p>You need to be an artist to apply for an event!</p>
                    </div>
                    @elseif (\Session::has('success'))
                    <div class="m-apply-form-warning">
                        <p>You're application was sent!</p>
                    </div>
                    @elseif ($applied)
                    <div class="m-apply-form-warning">
                        <p>You already applied for this event</p>
                    </div>
                    @else
                        <div class="row">
                            <div class="col-10 offset-1">
                                <label for="content">Message</label>
                                <textarea name="content" id="" class="a-textarea" required></textarea>
                                <input type="hidden" value="{{$event->id}}" name="event_id">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10 offset-1">
                                <button type="submit">Send application</button>
                            </div>
                        </div>
                    @endif
                @endif
            </form>

        </div>
    </div>
</div>
@endsection
