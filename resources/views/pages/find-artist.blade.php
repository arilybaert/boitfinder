@extends('layouts.app')
@section('content')
<div class="row">
    {{-- filter  --}}
    <div class="col-3 o-filters">
        <form action="" method="post">

            {{-- submit button --}}

            <div class="row m-filter-button">
                <div class="col-10 offset-2">
                    <button type="submit" class="a-filter-button">Apply Filters</button>
                </div>
            </div>

            {{-- filter items --}}

            <div class="row o-filter-item">
                <div class="col-2 m-filter-icon">
                    <i class="far fa-calendar-alt a-filter-icon"></i>
                </div>
                <div class="col-10">
                    <h3 class="a-filter-item-title">
                        Date
                    </h3>
                </div>
                <div class="col-10 offset-2 m-filter-input-date">
                    <input type="date" name="date-from" id="" class="a-filter-input-date" placeholder="from">
                    <input type="date" name="date-to" id="" class="a-filter-input-date" placeholder="to">
                </div>
            </div>

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
                    {{-- <label for="pas" class="m-filter-input-checkbox-container">
                        Full Band
                        <input type="checkbox" name="pas" class="a-filter-input-checkbox">
                        <span class="a-filter-input-checkmark"></span>
                    </label> --}}
                    <label class="container">
                        Full Band
                        <input type="checkbox" >
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">
                        Akoustic
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
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
                    <label class="container">
                        Vocals
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">
                        Stringed instruments
                        <input type="checkbox" >
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">
                        Piano
                        <input type="checkbox" >
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">
                        Drum
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
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
                    <label class="container">
                        House
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">
                        Rock
                        <input type="checkbox" >
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">
                        Metal
                        <input type="checkbox" >
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">
                        Alternative
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">
                        Indie
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">
                        Ska
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
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
