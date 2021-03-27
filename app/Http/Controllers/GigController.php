<?php

namespace App\Http\Controllers;

use App\Models\Pa;
use App\Models\Event;
use Illuminate\Http\Request;

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
        $pas = Pa::all();
        $events = Event::all();

        // dd($events);
        return view('pages.home', [
            'pas' => $pas,
            'events' => $events
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
