<div class="col-3">
    <div class="m-profile-sidebar">
        <a href="{{route('event.profile.events')}}">
            <h3><span class="{{$type === 'event' ? 'a-active-event' : ''}}">Events</span></h3>
        </a>
        <a href="{{route('edit.profile.event')}}">
            <h3><span class="{{$type === 'profile' ? 'a-active-event' : ''}}">Edit profile</span></h3>
        </a>
        <a href="{{route('event.password.change')}}">
            <h3><span class="{{$type === 'password' ? 'a-active-event' : ''}}">Password</span></h3>
        </a>
        <a href="{{route('event.media')}}">
            <h3><span class="{{$type === 'media' ? 'a-active-event' : ''}}">Media</span></h3>
        </a>
    </div>
</div>
