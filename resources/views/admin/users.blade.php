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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                    Delete
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        By deleting this user you will erase all his data, including but not limited to the events that are posted on the website.
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{ route('admin.users.delete', $user->id) }}">
                            <button type="button" class="btn btn-danger">I'm sure</button>
                        </a>
                        </div>
                    </div>
                    </div>
                </div>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
@endsection
