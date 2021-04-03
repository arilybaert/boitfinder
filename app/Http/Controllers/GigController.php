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
        // convert time and date
        $from = Carbon::parse($r->date_from)->toDatetimeString();
        $to = Carbon::parse($r->date_to)->toDatetimeString();

        // Get all events
        $events = Event::all();
        // Get all microphones, genres, pas
        $microphones = Microphone::all();
        $genres = Genre::orderBy('name')->get();
        $pas = Pa::all();

        // Filter the genres
        $r->genres > 0 ? $events = $events->whereIn('genre_id', $r->genres) : '';
        // Set start date
        $r->date_from !== null ? $events = $events->where('date', '>=', $from) : '';
        // Set end date
        $r->date_to !== null ? $events = $events->where('date', '<=', $to) : '';

        // loop over all events
        // echo '<pre>';
        // var_dump($r->microphones);
        // echo '</pre>';

        /*
        *** Filter microphones
        */
        foreach ($events as $key => $event) {
            // make array with all the mics for one event
            $event_mics =[];
            foreach($event->user->microphones as $microphone) {
                array_push($event_mics, $microphone->microphone_id);
            }
            // delete events if it doesn't have the requested microphone
            if($r->microphones > 0) {
                foreach ($r->microphones as $checkbox_microphone) {
                    if(!in_array($checkbox_microphone, $event_mics)) {
                        unset($events[$key]);
                    }
                }
            }
        }
        // Filter PA-System
        foreach ($events as $key => $event) {
            // if($r->pas[0] === '1'){
            //     if($event->user->pa_id !== 1 && $event->user->pa_id !== 2){
            //         unset($events[$key]);
            //     }
            // }elseif ($r->pas[0] === '2') {
            //     if($event->user->pa_id !== 2){
            //         unset($events[$key]);
            //     }
            // }
            switch ($r->pas[0]) {
                // if pa is acoutic allow users with fullband en acoustic systems
                case '1':
                    if($event->user->pa_id !== 1 && $event->user->pa_id !== 2){
                        unset($events[$key]);
                    }
                    break;
                 // only allow full band systems
                case '2':
                    if($event->user->pa_id !== 2){
                        unset($events[$key]);
                    }
                    break;
                // default:
                //     # code...
                //     break;
            }
        }
        // dd($events);


        return view('pages.home', [
            'events' => $events,
            'genres' => $genres,
            'microphones' => $microphones,
            'pas' => $pas,
            'r_pas' => $r->pas,
            'r_microphones' => $r->microphones,
            'r_genres' => $r->genres,
            'date_from' => $r->date_from,
            'date_to' => $r->date_to,
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
