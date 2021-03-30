@extends('layouts.profile')
@section('content')

<form method="POST" class="row o-profile-events">
    <x-sidebar/>

    <div class="col-9">
        {{-- event header  --}}
        <div class="row o-events-header">
            <div class="col-6">
                <h2>Create event</h2>
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
                        <label for="date">Date</label>
                    </div>
                    <div class="col-8">
                        <input type="date" name="date">
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="mic">Available mics</label>
                    </div>
                    <div class="col-8 o-filter-input-checkbox">
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
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="mic">Available PA</label>
                    </div>
                    <div class="col-8 o-filter-input-checkbox">
                        <label class="container">
                            acoustic
                            <input type="checkbox" checked="checked">
                            <span class="checkmark"></span>
                        </label>
                        <label class="container">
                            Full band
                            <input type="checkbox" >
                            <span class="checkmark"></span>
                        </label>

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
