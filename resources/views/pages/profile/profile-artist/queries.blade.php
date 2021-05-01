@extends('layouts.profile')
@section('content')
<div class="row o-profile-events" >
    @csrf

    <x-sidebar type="members"/>
    <div class="col-9">
        {{-- event header  --}}
        <div class="row o-events-header">
            <div class="col-6">
                <h2>Saved queries</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 o-queries">
                <table>
                    <tr>
                        <th>Date from</th>
                        <th>Date to</th>
                        <th>City</th>
                        {{-- <th>P.A.</th>
                        <th>Microphones</th> --}}
                        <th>Distance</th>
                        {{-- <th>Genres</th> --}}
                        <th>Action</th>
                    </tr>
                    @foreach ($queries as $querie)
                        <tr>
                            <td>{{ date("d-m-Y", strtotime($querie->date_from)) }}</td>
                            <td>{{ date("d-m-Y", strtotime($querie->date_to)) }}</td>
                            <td>{{ $querie->city }}</td>
                            <td>{{ $querie->distance  }}</td>
                            {{-- <td>{{ unserialize($querie->pas) }}</td>
                            {{-- <td>{{ unserialize($querie->microphones) }}</td>
                            <td>{{ $querie->genres }}</td> --}}
                            <td>
                                <a href="{{ route('artist.queries.delete', $querie->id) }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
