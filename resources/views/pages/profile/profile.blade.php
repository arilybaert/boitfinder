@extends('layouts.profile')
@section('content')
<form method="POST" class="row o-profile-events" action="{{route('save.profile.event')}}">
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
                <div class="row m-form-group">
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
                        <input type="text" name="city" value="{{ old('city', ($user ? $user->city : '')) }}">
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
                @if($user->role === 'artist')
                    <div class="row m-form-group">
                        <div class="col-4">
                            <label for="rider">Rider</label>
                        </div>
                        <div class="col-8">
                            <input type="file" name="rider" id="">
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
                        <label for="coverphoto">Coverphoto</label>
                    </div>
                    <div class="col-9">
                        <input type="file" name="coverphoto" id="">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-9 offset-3 m-submit">
        <button type="submit">Create</button>
    </div>
</form>
@endsection
