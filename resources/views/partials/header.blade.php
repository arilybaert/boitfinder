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
                            <h2>
                                Find Gig
                            </h2>
                            <h2>
                                Find Artist
                            </h2>
                        </div>
                        <a href="{{ route('home') }}"class="col-4 m-site-logo">
                            <img src="{{ asset('src/img/logo/gigfinder_logo.png') }}" alt="">
                        </a>
                        <div class="col-4 m-header-menu">
                            <h2>
                                Profile
                            </h2>
                            <h2>
                                Login
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

