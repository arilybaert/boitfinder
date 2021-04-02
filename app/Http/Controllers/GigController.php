<?php

namespace App\Http\Controllers;

use App\Models\Pa;
use App\Models\Event;
use App\Models\Genre;
use App\Models\Microphone;
use Illuminate\Http\Request;

class GigController extends Controller
{
    // Redirect home to find event
    public function getIndex()
    {
        $microphones = Microphone::all();
        $pas = Pa::all();
        return redirect()->route('find.event');
    }

    // Find event
    public function getFindEvent()
    {
        $microphones = Microphone::all();
        $pas = Pa::all();
        $events = Event::all();
        $genres = Genre::orderBy('name')->get();

        // dd($events);
        return view('pages.home', [
            'pas' => $pas,
            'events' => $events,
            'microphones' => $microphones,
            'genres' => $genres,
        ]);
    }
    // Find event detail
    public function getEvent(Event $event)
    {
        return view('pages.event-detail', [
            'event' => $event
        ]);
    }
}
