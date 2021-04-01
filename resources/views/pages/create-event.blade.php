@extends('layouts.profile')
@section('content')

<form method="POST" class="row o-profile-events" action="{{route('event.create.save')}}">
    @csrf
    <x-sidebar type="event"/>

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
                {{-- <div class="row m-form-group">
                    <div class="col-4">
                        <label for="mic">Available mics</label>
                    </div>
                    <div class="col-8 o-filter-input-checkbox">
                        @foreach ($microphones as $microphone)
                            <label class="container">
                                {{$microphone->name}}
                                <input type="checkbox" name="microphones[]">
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
                                <input type="checkbox" name="pas[]" value="{{$pa->id}}">
                                <span class="checkmark"></span>
                            </label>
                        @endforeach
                    </div>
                </div> --}}
            </div>
            <div class="col-6">
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="description">Description</label>
                    </div>
                    <div class="col-8">
                        <textarea name="description" id=""></textarea>
                    </div>
                </div>
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="coverphoto">Coverphoto</label>
                    </div>
                    <div class="col-8">
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
