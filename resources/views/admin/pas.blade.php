@extends('layouts.admin')
@section('content')
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pas as $pa)
      <tr>
        <form method="POST" action="{{ route('admin.pas.save') }}">
            @csrf
            <td>{{ $pa->id }}</td>
            <td>
                <input type="text" value="{{ $pa->name }}" name="name">
                <input type="hidden" value="{{ $pa->id }}" name="id">
            </td>
            <td>
                {{-- <a href="{{ route('admin.pas.save', $pa->id) }}"> --}}
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>

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
                            By deleting a PA you can mess with the overal flow of the website! This action will delete the PA on all user profiles
                            </div>
                            <div class="modal-footer">
                            <a href="{{ route('admin.pas.delete', $pa->id) }}">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger">I'm sure</button>
                            </a>
                            </div>
                        </div>
                        </div>
                    </div>
            </td>
        </form>
      </tr>
      @endforeach

    </tbody>
  </table>
@endsection
