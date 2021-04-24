@extends('layouts.profile')
@section('content')
<form method="POST" class="row o-profile-events" action="{{route('save.profile.event')}}" enctype="multipart/form-data">
    @csrf

    <x-sidebar type="profile"/>
    <div class="col-9">
        {{-- event header  --}}
        <div class="row o-events-header">
            <div class="col-6">
                <h2>Your profile</h2>
            </div>
        </div>

        {{-- upcoming events  --}}
        <div class="row o-create-event">
            <div class="col-6">
                <div class="row m-form-group" autocomplete="off">
                    <div class="col-4">
                        <label for="name">Name</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="name" value="{{ old('firstname', ($user ? $user->name : '')) }}">
                        <input type="hidden" name="id" value="{{ ($user ? $user->id : '') }}">
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="telephone">Telephone</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="telephone" value="{{ old('telephone', ($user ? $user->telephone : '')) }}">
                    </div>
                </div>
                @if ($user->role === 'event')
                    <div class="row m-form-group">
                        <div class="col-4">
                            <label for="address">Address</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="address" value="{{ old('address', ($user ? $user->address : '')) }}">
                        </div>
                    </div>
                @endif
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="zipcode">Zipcode</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="zipcode" value="{{ old('zipcode', ($user ? $user->zipcode : '')) }}">
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="city">City</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="location" class="a-filter-input-location a-filter-input" placeholder="brussel" id="a-input-city" value="{{ old('location', ($user->city ? $user->city : '')) }}">
                        <input type="hidden" name="latitude" id="a-latitude" value="{{ old('latitude', ($user->latitude ? $user->latitude : '')) }}">
                        <input type="hidden" name="longitude" id="a-longitude" value="{{ old('longitude', ($user->longitude ? $user->longitude : '')) }}">
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="website">Website</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="website" value="{{ old('website', ($user ? $user->website : '')) }}">
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="capacity">Capacity</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="capacity" value="{{ old('capacity', ($user ? $user->capacity : '')) }}">
                    </div>
                </div>
                @if($user->role === 'event')
                    <div class="row m-form-group">
                        <div class="col-4">
                            <label for="mic">Available mics</label>
                        </div>
                        <div class="col-8 o-filter-input-checkbox">
                            @foreach ($microphones as $microphone)
                                    <label class="container">
                                        {{$microphone->name}}
                                        <input type="checkbox" name="microphones[]" value="{{ $microphone->id }}" {{ in_array($microphone->id, $user_microphones) ? 'checked' : '' }} >
                                        <span class="checkmark"></span>
                                    </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="row m-form-group">
                        <div class="col-4">
                            <label for="mic">Available PA</label>
                        </div>
                        <div class="col-8 o-filter-input-checkbox">
                            @foreach ($pas as $pa)
                                <label class="container">
                                    {{$pa->name}}
                                    <input type="radio" name="pa_id œ" value="{{$pa->id}}" {{ $pa->id === $user->pa_id ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-6">
                <div class="row m-form-group">
                    <div class="col-3">
                        <label for="description">Description</label>
                    </div>
                    <div class="col-9">
                        <textarea name="description" id="">{{ old('description', ($user ? $user->description : '')) }}</textarea>
                    </div>
                </div>
                @if ($user->role === 'artist')
                    <div class="row m-form-group">
                        <div class="col-3">
                            <label for="genre_description">Genre description</label>
                        </div>
                        <div class="col-9">
                            <textarea name="genre_description" id="">{{ old('genre_description', ($user ? $user->genre_description : '')) }}</textarea>
                        </div>
                    </div>
                @endif
                <div class="row m-form-group">
                    <div class="col-3">
                        <label for="vimeo_id">Video</label>
                    </div>
                    <div class="col-9">
                        <input type="text" name="vimeo_id" value="{{ old('vimeo_id', ($user ? $user->vimeo_id : '')) }}" placeholder="vimeo video id">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-9 offset-3 m-submit">
        <button type="submit">Save</button>
    </div>
</form>
@endsection
