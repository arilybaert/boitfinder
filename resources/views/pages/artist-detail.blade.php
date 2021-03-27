@extends('layouts.app')
@section('content')


{{-- image --}}
<div class="row">
    <div class="col-10 offset-1 o-artist-detail-cover">
        <img src="{{ asset($artist->coverphoto) }}" alt="" class="a-artist-detail-cover">
        <h2>{{$artist->name}}</h2>
    </div>
</div>

{{-- artist details --}}
<div class="row">
    <div class="col-10 offset-1 m-artist-details" id="m-artist-details">
        <div class="row">
            <div class="col-10">
                <div class="row">
                    @foreach($artist->bandmembers as $bandmember)
                        <div class="col-3 m-artist-members">
                            <img src="{{ asset($bandmember->photo)}}" alt="">
                            <h5>{{$bandmember->function}}</h5>
                            <h4>{{$bandmember->name}}</h4>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>

{{-- artist description and contact information --}}
<div class="row o-artist-detail">
    <div class="col-10 offset-1">
        <div class="row">
            {{-- artist description  --}}
            <div class="col-8">
                <div class="row">
                    <div class="col-12">
                        <h3>
                            Genre
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p>
                            {{ $artist->genre_description}}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>
                            Description
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p>
                            {{ $artist->description}}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <button class="col-4 offset-4">
                        Download rider
                    </button>
                </div>
            </div>
            {{-- artist contact information --}}
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
                                {{ $artist->zipcode . ', ' . $artist->city}}
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
                                {{ $artist->telephone}}
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
                                {{ $artist->website}}
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
<div class="o-apply-form" id="o-apply-form">
    <div class="row m-apply-form">
        <div class="col-6 offset-3">
            <form action="" id="o-form">
                <div class="row">
                    <div class="col-12">
                        <h2>Apply now</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 offset-1">
                        <label for="content">Message</label>
                        <textarea name="content" id="" class="a-textarea"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 offset-1">
                        <button type="submit">Send application</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
