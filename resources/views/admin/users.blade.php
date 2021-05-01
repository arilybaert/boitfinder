@extends('layouts.admin')
@section('content')
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">role</th>
        <th scope="col">city</th>
        <th scope="col">action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>
        <td>{{ $user->city }}</td>
        <td>
            <a href="{{ route('admin.users.edit', $user->id) }}">
                <button type="button" class="btn btn-primary">
                    Edit
                </button>
            </a>
            @if ($user->deleted_at === null)
                <a href="{{ route('admin.users.delete', $user->id) }}">
                    <button type="button" class="btn btn-danger">
                        Delete
                    </button>
                </a>
            @else
            <a href="{{ route('admin.users.activate', $user->id) }}">
                <button type="button" class="btn btn-warning">
                    Activate
                </button>
            </a>
            @endif
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
@endsection
