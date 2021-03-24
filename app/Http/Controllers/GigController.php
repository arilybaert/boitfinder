<?php

namespace App\Http\Controllers;

use App\Models\Pa;
use App\Models\Event;
use Illuminate\Http\Request;

class GigController extends Controller
{
    public function getIndex()
    {
        $pas = Pa::all();
        $events = Event::all();

        dd($events);
        return view('pages.home', [
            'pas' => $pas,
            'event' => $events
        ]);
    }
}
