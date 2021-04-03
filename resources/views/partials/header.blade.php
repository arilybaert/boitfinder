<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/1f9fa605a9.js" crossorigin="anonymous"></script>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="o-header">
                    <div class="row m-header">
                        <div class="col-4 m-header-menu">
                            <a href="{{ route('find.event')}} ">
                                <h2>
                                    Find Gig
                                </h2>
                            </a>
                            <a href="{{ route('find.artist')}} ">
                                <h2>
                                    Find Artist
                                </h2>
                            </a>
                        </div>
                        <div class="col-4">
                            <div class="o-site-logo">
                                <div class="m-site-logo">
                                    <a href="{{ route('home') }}"class="">
                                        <img src="{{ asset('src/img/logo/gigfinder_logo.png') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 m-header-menu">
                            @if (Auth::check())
                                <a href="{{ route('event.profile.events')}} ">
                                    <h2>
                                        Profile
                                    </h2>
                                </a>
                            @else
                                <a href="{{ route('register')}} ">
                                    <h2>
                                        Register
                                    </h2>
                                </a>
                            @endif


                            @if (!Auth::check())
                                <a href="{{ route('login')}} ">
                                    <h2>
                                        Login
                                    </h2>
                                </a>
                            @else
                                <form action="{{ route('logout')}}" method="post">
                                    @csrf
                                    <button>
                                        Logout
                                    </button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

