<div class="col-3">
    <div class="m-profile-sidebar">
        <?php $user = Auth::user()->role; ?>
        @if ($user === 'event')
            <a href="{{route('event.profile.events')}}">
                <h3><span class="{{$type === 'event' ? 'a-active-event' : ''}}">Events</span></h3>
            </a>
        @endif

        @if($user === 'artist')
            <a href="{{route('artist.profile.events')}}">
                <h3><span class="{{$type === 'event' ? 'a-active-event' : ''}}">Events</span></h3>
            </a>
        @endif
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
