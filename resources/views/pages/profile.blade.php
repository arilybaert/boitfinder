@extends('layouts.profile')
@section('content')
<form method="POST" class="row o-profile-events">
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
                        <input type="text" name="name">
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="telephone">Telephone</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="telephone">
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="address">Address</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="address">
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="zipcode">Zipcode</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="zipcode">
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="city">City</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="city">
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="website">Website</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="website">
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="capacity">Capacity</label>
                    </div>
                    <div class="col-8">
                        <input type="text" name="capacity">
                    </div>
                </div>

            </div>
            <div class="col-6">
                <div class="row m-form-group">
                    <div class="col-3">
                        <label for="description">Description</label>
                    </div>
                    <div class="col-9">
                        <textarea name="description" id=""></textarea>
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-3">
                        <label for="coverphoto">Coverphoto</label>
                    </div>
                    <div class="col-9">
                        <input type="file" name="" id="">
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
