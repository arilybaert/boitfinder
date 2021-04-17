@extends('layouts.profile')
@section('content')
<form method="POST" class="row o-profile-events" action="{{route('artist.members')}}">
    @csrf

    <x-sidebar type="members"/>
    <div class="col-9">
        {{-- event header  --}}
        <div class="row o-events-header">
            <div class="col-6">
                <h2>Band members</h2>
            </div>
            <div class="col-6 o-bandmembers-button">
                <button type="submit">Save</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="o-table-members">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                        <tr>
                            <td>
                                <input type="text" name="name[]" class="a-input a-input-name" value="{{ $member ? $member->name : '' }}">
                                <input type="hidden" name="id[]" value="{{ $member ? $member->id : '' }}">
                            </td>
                            <td>
                                <input type="text" name="function[]" class="a-input a-input-function" value="{{ $member ? $member->function : '' }}" >
                            </td>
                            <td>
                                <img src="{{asset($member->photo)}}">
                            </td>
                            <td class="m-action">
                                <a href="{{route('artist.members.delete', $member->id)}}" class="a-delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                {{-- <div class="a-js-button">
                                    <div class="a-delete a-edit-button">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <div class="a-delete a-save-button">
                                        <button type="submit">
                                            <i class="far fa-save"></i>
                                        </button>
                                    </div>
                                </div> --}}

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
@endsection
