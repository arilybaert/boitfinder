@extends('layouts.app')
@section('content')
<div class="row">
    {{-- filter  --}}
    <div class="col-3 o-filters">
        <form action="{{route('find.artist')}} " method="post">
            @csrf
            {{-- submit button --}}

            <div class="row m-filter-button">
                <div class="col-10 offset-2">
                    <button type="submit" class="a-filter-button">Apply Filters</button>
                </div>
            </div>

                {{-- filter items --}}

                {{-- <div class="row o-filter-item">
                    <div class="col-2 m-filter-icon">
                        <i class="far fa-calendar-alt a-filter-icon"></i>
                    </div>
                    <div class="col-10">
                        <h3 class="a-filter-item-title">
                            Date
                        </h3>
                    </div>
                    <div class="col-10 offset-2 m-filter-input-date">
                        <input type="date" name="date_from" id="" class="a-filter-input-date" placeholder="from"  value="{{ old('date', ($date_from ? date('Y-m-d', strtotime($date_from)) : '')) }}">
                        <input type="date" name="date_to" id="" class="a-filter-input-date" placeholder="to" value="{{ old('date', ($date_to ? date('Y-m-d', strtotime($date_to)) : '')) }}">
                    </div>
                </div> --}}

                {{-- P.A. system --}}
                <div class="row o-filter-item">
                    <div class="col-2 m-filter-icon">
                        <i class="fas fa-volume-up a-filter-icon"></i>
                    </div>
                    <div class="col-10">
                        <h3 class="a-filter-item-title">
                            PA System
                        </h3>
                    </div>
                    <div class="col-10 offset-2 o-filter-input-checkbox">
                        @foreach ($pas as $pa)
                            <label class="container">
                                {{$pa->name}}
                                <input type="checkbox" name="pas[]" value="{{$pa->id}}" @if(is_array($r_pas) && in_array($pa->id, $r_pas)) checked @endif>
                                <span class="checkmark"></span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Microphones --}}

                <div class="row o-filter-item">
                    <div class="col-2 m-filter-icon">
                        <i class="fas fa-microphone a-filter-icon"></i>
                    </div>
                    <div class="col-10">
                        <h3 class="a-filter-item-title">
                            Microphones
                        </h3>
                    </div>
                    <div class="col-10 offset-2 o-filter-input-checkbox">
                        @foreach ($microphones as $microphone)
                            <label class="container">
                                {{$microphone->name}}
                                <input type="checkbox" name="microphones[]" value="{{$microphone->id}}" @if(is_array($r_microphones) && in_array($microphone->id, $r_microphones)) checked @endif>
                                <span class="checkmark"></span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Location --}}

                <div class="row o-filter-item">
                    <div class="col-2 m-filter-icon">
                        <i class="fas fa-map-pin a-filter-icon"></i>
                    </div>
                    <div class="col-10">
                        <h3 class="a-filter-item-title" id="a-location">
                            Location (km)
                        </h3>
                    </div>
                    <div class="col-10 offset-2 m-filter-input">
                        <input type="text" name="location" class="a-filter-input-location a-filter-input" placeholder="brussel" id="a-input-city" value="{{ old('location', ($r_location ? $r_location : '')) }}">
                        <input type="hidden" name="latitude" id="a-latitude" value="{{ old('latitude', ($r_latitude ? $r_latitude : '')) }}">
                        <input type="hidden" name="longitude" id="a-longitude" value="{{ old('longitude', ($r_longitude ? $r_longitude : '')) }}">
                    </div>
                    <div class="col-10 offset-2 m-filter-input">
                        <div class="a-location-button a-button__left" id="a-location-minus-button">-</div>
                        <input type="number" name="distance" placeholder="50" class="a-distance-input" id="a-input-distance" value="{{ old('distance', ($r_distance ? $r_distance : '')) }}">
                        <div class="a-location-button a-button__right" id="a-location-plus-button">+</div>
                    </div>

                </div>

                {{-- Genres --}}

                <div class="row o-filter-item">
                    <div class="col-2 m-filter-icon">
                        <i class="fas fa-music a-filter-icon"></i>
                    </div>
                    <div class="col-10">
                        <h3 class="a-filter-item-title">
                            Genres
                        </h3>
                    </div>
                    <div class="col-10 offset-2 o-filter-input-checkbox">
                        @foreach ($genres as $genre)
                        <label class="container">
                            {{$genre->name}}
                            <input type="checkbox" name="genres[]" value="{{$genre->id}}" @if(is_array($r_genres) && in_array($genre->id, $r_genres)) checked @endif>
                            <span class="checkmark"></span>
                        </label>
                        @endforeach

                    </div>
                </div>
        </form>
    </div>

    {{-- artist cards  --}}
    <div class="col-9 o-artist-cards">
        <div class="row">

            @foreach ($artists as $artist)
                <a href="{{route('artist', $artist->id)}}" class="col-4 o-artist-card">
                    <div class="m-artist-card">
                        <div class="m-artist-card-image-container">
                            <img src="{{ asset($artist->coverphoto)}} " alt="">
                        </div>
                        <h2>
                            {{$artist->name}}
                        </h2>
                        <h3>
                            {{$artist->city}}
                        </h3>
                        <div class="a-border-bottom"></div>
                        <p>
                            <?php
                            if(strlen($artist->description)<=150)
                                {
                                    echo $artist->description;
                                }
                                else
                                {
                                    $y=substr($artist->description,0,200) . '...';
                                    echo $y;
                                };
                            ?>
                        </p>
                        <div class="a-border-bottom"></div>
                        <div class="m-artist-card-genres">
                            <i class="fas fa-music a-card-icon"></i>
                            @foreach($artist->genres as $genre)
                            <h5>{{$genre->genre->name}}</h5>
                        @endforeach
                        </div>
                    </div>
                </a>
            @endforeach






        </div>
    </div>
</div>
@endsection
