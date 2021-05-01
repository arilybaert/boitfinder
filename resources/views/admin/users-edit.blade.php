@extends('layouts.admin')
@section('content')

<div class="container">

    <form method="POST" action="{{ route('admin.users.save') }}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="hidden" class="form-control" id="id" name="id" value="{{ $user ? $user->id : '' }}">

                <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{ $user ? $user->name : '' }}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="text" class="form-control" id="inputEmail4" placeholder="Email" value="{{ $user ? $user->email : '' }}" name="email">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" placeholder="website" name="website" value="{{ $user ? $user->website : '' }}">
            </div>
            <div class="form-group col-md-6">
                <label for="telephone">Telephone</label>
                <input type="text" class="form-control" id="telephone" placeholder="0472535352" value="{{ $user ? $user->telephone : '' }}" name="telephone">
            </div>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Avenue de Woluwe 124" value="{{ $user ? $user->address : '' }}" name="address">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="role">Role</label>
                <select id="role" class="form-control" name="role">
                    <option value="admin" {{ $user->role === "admin" ? 'selected' : '' }} >Admin</option>
                    <option value="artist" {{ $user->role === "artist" ? 'selected' : '' }} >Artist</option>
                    <option value="event" {{ $user->role === "event" ? 'selected' : '' }} >Event</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" placeholder="Brussels" value="{{ $user ? $user->city : '' }}" name="city">
            </div>
            <div class="form-group col-md-2">
                <label for="zipcode">zipcode</label>
                <input type="text" class="form-control" id="zipcode" placeholder="1000" value="{{ $user ? $user->zipcode : '' }}" name="zipcode">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" id="description" name="description">{{ $user ? $user->description : '' }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
</div>
@endsection
