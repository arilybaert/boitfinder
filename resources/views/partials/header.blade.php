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


        <script src="https://code.jquery.com/jquery-3.4.1.js" type="text/javascript"></script>
        <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                font: 16px Arial;
            }

            /*the container must be positioned relative:*/
            .autocomplete {
                position: relative;
                display: inline-block;
            }

            input {
                border: 1px solid transparent;
                background-color: #f1f1f1;
                padding: 10px;
                font-size: 16px;
            }

            input[type=text] {
                background-color: #f1f1f1;
                width: 100%;
            }

            input[type=submit] {
                background-color: DodgerBlue;
                color: #fff;
                cursor: pointer;
            }

            .autocomplete-items {
                position: absolute;
                border: 1px solid #d4d4d4;
                border-bottom: none;
                border-top: none;
                z-index: 99;
                /*position the autocomplete items to be the same width as the container:*/
                top: 100%;
                left: 0;
                right: 0;
            }

            .autocomplete-items div {
                padding: 10px;
                cursor: pointer;
                background-color: #fff;
                border-bottom: 1px solid #d4d4d4;
            }

            /*when hovering an item:*/
            .autocomplete-items div:hover {
                background-color: #e9e9e9;
            }

            /*when navigating through the items using the arrow keys:*/
            .autocomplete-active {
                background-color: DodgerBlue !important;
                color: #ffffff;
            }
        </style>
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

