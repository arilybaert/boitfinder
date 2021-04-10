<?php

namespace App\Http\Controllers;

use App\Models\Microphone;
use App\Models\Genre;
use App\Models\Pa;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ArtistController extends Controller
{
        // Find event
    public function getFindArtist()
    {
        $artists = User::where('role', 'artist')->get();
        $pas = Pa::all();
        $microphones = Microphone::all();
        $genres = Genre::all();

        return view('pages.find-artist', [
            'artists' => $artists,
            'pas' => $pas,
            'genres' => $genres,
            'microphones' => $microphones,
            'r_pas' => [],
            'r_microphones' => [],
            'r_genres' => []
        ]);
    }
    // Filter artists
    public function postFindArtist(Request $r)
    {
        // Get all events
        $artists = User::where('role', 'artist')->get();

        // Get all microphones, genres, pas
        $microphones = Microphone::all();
        $genres = Genre::orderBy('name')->get();
        $pas = Pa::all();

        // Filter the genres
        if($r->genres > 0) {
            foreach ($artists as $key => $artist) {
                $artist_genres = [];
                foreach($artist->genres as $genre) {
                    array_push($artist_genres, $genre->genre_id);
                }

                if (count(array_intersect($artist_genres,$r->genres)) === 0) {
                    unset($artists[$key]);
                }
            }
        }

        /*
        *** Filter microphones
        */
        foreach ($artists as $key => $artist) {
            // make array with all the mics for one event
            $event_mics =[];
            foreach($artist->microphones as $microphone) {
                array_push($event_mics, $microphone->microphone_id);
            }
            // delete events if it doesn't have the requested microphone
            if($r->microphones > 0) {
                foreach ($r->microphones as $checkbox_microphone) {
                    if(!in_array($checkbox_microphone, $event_mics)) {
                        unset($artists[$key]);
                    }
                }
            }
        }
        // Filter PA-System
        foreach ($artists as $key => $artist) {
            switch ($r->pas[0]) {
                // if pa is acoutic allow users with fullband en acoustic systems
                case '1':
                    if($artist->pa_id !== 1 && $artist->pa_id !== 2){
                        unset($artists[$key]);
                    }
                    break;
                 // only allow full band systems
                case '2':
                    if($artist->pa_id !== 2){
                        unset($artists[$key]);
                    }
                    break;
            }
        }


        return view('pages.find-artist', [
            'artists' => $artists,

            'genres' => $genres,
            'microphones' => $microphones,
            'pas' => $pas,

            'r_pas' => $r->pas,
            'r_microphones' => $r->microphones,
            'r_genres' => $r->genres,
        ]);
    }

    public function getArtist(User $artist)
    {
        // get songs from db
        $song_files = [];
        // UNCOMMENT TO USE DB SONGS
        // $song_files = Storage::disk('s3')->allFiles('songs/' . $artist->id);

        // get photos from db
        $photo_files = [
            "src/img/event/cover/cover-0.jpg",
            "src/img/event/cover/cover-1.jpg",
            "src/img/event/cover/cover-2.jpg",
            "src/img/event/cover/cover-3.jpg",
        ];
        // UNCOMMENT TO USE DB PICTURES
        // $photo_files = Storage::disk('s3')->allFiles('photos/' . $artist->id);

        // dd($photo_files);
        // $photo_files = [];
        return view('pages.artist-detail', [
            'artist' => $artist,
            'song_files' => $song_files,
            'photo_files' => $photo_files
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


        return view('pages.profile.profile-artist.profile-event', [
            'future_events' => $future_events,
            'passed_events' => $passed_events,
        ]);
    }
}
