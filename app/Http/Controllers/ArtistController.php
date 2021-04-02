<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArtistController extends Controller
{
        // Find event
    public function getFindArtist()
    {
        $artists = User::where('role', 'artist')->get();

        // dd($artists);
        // dd($events);
        return view('pages.find-artist', [
            'artists' => $artists,
        ]);
    }

    public function getArtist(User $artist)
    {
        return view('pages.artist-detail', [
            'artist' => $artist
        ]);
    }
    // download rider
    public function getRider()
    {
        // Storage::disk('local')->put('example.txt', 'Contents');
        return Storage::download('public/docs/artist-riders/rider.png');
    }
    // show events where the user has applied for
    public function getEvents()
    {
        // $now = Carbon::now();
        // if (Auth::check()){
        //     $user_id = Auth::id();
        //     $future_events = Event::where('date', '>', $now)->orderBy('date', 'asc')->get();
        //     // ->join('applicants', 'events.id', '=', 'applicants.event_id')
        //     dd($future_events);
        //     // $passed_events = Applicant::where('user_id', $user_id)->where('date', '<', $now)->orderBy('date', 'asc')->get();
        // }
        $now = Carbon::now();
        if (Auth::check()){
            $user_id = Auth::id();
            // future events
            $future_events = Event::join('applicants', 'events.id', '=', 'applicants.event_id')
            ->select('applicants.user_id', 'applicants.status', 'events.coverphoto', 'events.name', 'events.date', 'events.id')
            ->where('applicants.user_id', $user_id)
            ->where('events.date', '>', $now)->orderBy('date', 'asc')->get();

            // historic events
            $passed_events = Event::join('applicants', 'events.id', '=', 'applicants.event_id')
            ->select('applicants.user_id', 'applicants.status', 'events.coverphoto', 'events.name', 'events.date', 'events.id')
            ->where('applicants.user_id', $user_id)
            ->where('events.date', '<', $now)->orderBy('date', 'asc')->get();
        }


        return view('pages.artist.profile-event', [
            'future_events' => $future_events,
            'passed_events' => $passed_events,
        ]);
    }
}
