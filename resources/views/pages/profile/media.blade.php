@extends('layouts.profile')
@section('content')
<div class="row o-profile-events">
    <x-sidebar type="media"/>
    <div class="col-9">
        <livewire:file-uploader/>
    </div>
</div>

@endsection
