<?php

namespace App\Http\Controllers;

use App\Models\Pa;
use App\Models\Event;
use App\Models\Genre;
use App\Models\Microphone;
use App\Models\MicrophonesUser;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GigController extends Controller
{
    // Redirect home to find event
    public function getIndex()
    {
        return redirect()->route('find.event');
    }

    // Find event
    public function getFindEvent()
    {
        $events = Event::all();
        $genres = Genre::orderBy('name')->get();
        $microphones = Microphone::all();
        $pas = Pa::all();

        return view('pages.home', [
            'events' => $events,
            'genres' => $genres,
            'microphones' => $microphones,
            'pas' => $pas,
        ]);
    }

    public function postFindEvent(Request $r)
    {

        $from = Carbon::parse($r->date_from)->toDatetimeString();
        $to = Carbon::parse($r->date_to)->toDatetimeString();

        // dd($r);

        /*
        filter events by available microphones

        $microphones_users = MicrophonesUser::join('microphones', 'microphones_users.microphone_id', '=', 'microphones.id' )
        ->whereIn('microphone_id', $r->microphones)
        ->get();
        dd($microphones_users);

        */

        // Get all events
        $events = Event::all();
        // Get all microphones
        $microphones = Microphone::all();
        // Filter the genres
        $r->genres > 0 ? $events = $events->whereIn('genre_id', $r->genres) : '';
        // Set start date
        $r->date_from !== null ? $events = $events->where('date', '>=', $from) : '';
        // Set end date
        $r->date_to !== null ? $events = $events->where('date', '<=', $to) : '';

        // dd($events);
        // Filter microphones
        // $r->microphones > 0 $events = $events->where

        dd($events);
        return back('pages.home')->with(['events' => $events]);
    }

    // Find event detail
    public function getEvent(Event $event)
    {
        return view('pages.event-detail', [
            'event' => $event
        ]);
    }
}
