@extends('layouts.profile')
@section('content')
<form method="POST" class="row o-profile-events" action="{{route('artist.members')}}">
    @csrf

    <x-sidebar type="members"/>
    <div class="col-9">
        <div class="row">
            <table class="o-table-members">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Photo</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                    <tr>
                        <td>{{$member->name}}</td>
                        <td>{{$member->function}}</td>
                        <td>
                            <img src="{{asset($member->photo)}}">
                        </td>
                        <td>
                            <a href="{{route('artist.members.delete', $member->id)}}" class="a-delete">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>
@endsection
