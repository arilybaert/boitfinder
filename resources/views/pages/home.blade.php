@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-3 o-filters">
            <form action="{{route('find.event')}}" method="post">
                @csrf
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
                        <input type="date" name="date_from" id="" class="a-filter-input-date" placeholder="from">
                        <input type="date" name="date_to" id="" class="a-filter-input-date" placeholder="to">
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
                        @foreach ($pas as $pa)
                            <label class="container">
                                {{$pa->name}}
                                <input type="checkbox" name="pas[]" value="{{$pa->id}}">
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
                                <input type="checkbox" name="microphones[]" value="{{$microphone->id}}">
                                <span class="checkmark"></span>
                            </label>
                        @endforeach
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
                            <input type="checkbox" name="genres[]" value="{{$genre->id}}">
                            <span class="checkmark"></span>
                        </label>
                        @endforeach

                    </div>
                </div>
            </form>
        </div>
        <div class="col-9 o-event-cards">
            <div class="row">
                @foreach ($events as $event)
                    <a class="col-4 o-event-card" href="{{route('event', $event->id)}}">
                        <div class="m-event-card">
                            <div class="m-event-card-image-container">
                                <img src="{{ asset($event->coverphoto)}}" alt="" class="a-event-card-image">
                            </div>
                            <h2>
                                {{$event->name}}
                            </h2>
                            <h3>
                                {{$event->user->name}}
                            </h3>
                            <div class="a-border-bottom"></div>
                            <p>
                                <?php
                                if(strlen($event->description)<=150)
                                    {
                                        echo $event->description;
                                    }
                                    else
                                    {
                                        $y=substr($event->description,0,200) . '...';
                                        echo $y;
                                    };
                                ?>
                            </p>
                            <div class="a-border-bottom"></div>

                            <div class="m-event-card-genres">
                                <i class="fas fa-music a-card-icon"></i>
                                {{$event->genre->name}}
                            </div>
                            <div class="m-event-card-date">
                                <i class="far fa-calendar-alt a-card-icon"></i>
                                {{ date("d/m/Y",strtotime($event->date)) }}
                            </div>
                        </div>
                    </a>
                @endforeach


            </div>
        </div>
    </div>
@endsection
