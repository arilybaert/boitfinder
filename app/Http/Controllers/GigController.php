<?php

namespace App\Http\Controllers;
use App\Classes\CalcDistance;
use App\Models\Applicant;
use App\Models\Pa;
use App\Models\Event;
use App\Models\Genre;
use App\Models\Microphone;
use App\Models\SavedQuery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            'date_from' => '',
            'date_to' => '',
            'r_pas' => [],
            'r_microphones' => [],
            'r_genres' => [],
            'r_location' => '',
            'r_latitude' => '',
            'r_longitude' => '',
            'r_distance' => '',
        ]);
    }

    // Filter events
    public function postFindEvent(Request $r)
    {

        // Get all events
        $events = Event::all();
        // Get all microphones, genres, pas
        $microphones = Microphone::all();
        $genres = Genre::orderBy('name')->get();
        $pas = Pa::all();



        // convert time and date
        $from = Carbon::parse($r->date_from)->toDatetimeString();
        $to = Carbon::parse($r->date_to)->toDatetimeString();

        // filter distance
        if($r->distance > 0) {
            foreach ($events as $key => $event) {
                $distanceInKM = CalcDistance::vincentyGreatCircleDistance($r->latitude, $r->longitude, $event->user->latitude, $event->user->longitude) / 1000;
                if($distanceInKM > $r->distance) {
                    unset($events[$key]);
                }
            }
        }

        /* Filter the genres
        ***
        */

        $r->genres > 0 ? $events = $events->whereIn('genre_id', $r->genres) : '';
        // Set start date
        $r->date_from !== null ? $events = $events->where('date', '>=', $from) : '';
        // Set end date
        $r->date_to !== null ? $events = $events->where('date', '<=', $to) : '';

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
        /*
        *** Filter PA-system
        */
        foreach ($events as $key => $event) {
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
            }
        }

        // save search query to database
        if($r->action === 'save') {
            $data = [
                'date_from' => Carbon::parse($r->date_from)->toDatetimeString(),
                'date_to' => Carbon::parse($r->date_to)->toDatetimeString(),
                'pas' => serialize($r->pas),
                'microphones' => serialize($r->microphones),
                'latitude' => $r->latitude,
                'longitude' => $r->longitude,
                'distance' => $r->distance,
                'genres' => serialize($r->genres),
                'user_id' => Auth::user()->id,
            ];
            $query = SavedQuery::create($data);
        }

        return view('pages.home', [
            'events' => $events,
            'genres' => $genres,
            'microphones' => $microphones,
            'pas' => $pas,

            'r_pas' => $r->pas,
            'r_microphones' => $r->microphones,
            'r_genres' => $r->genres,
            'r_location' => $r->location,
            'r_distance' => $r->distance,
            'r_latitude' => $r->latitude,
            'r_longitude' => $r->longitude,
            'date_from' => $r->date_from,
            'date_to' => $r->date_to,
        ]);
    }

    // Find event detail
    public function getEvent(Event $event)
    {
        $applied = false;

        if (!Auth::guest()){

            $user = Auth::user();
            if(Applicant::where('user_id', $user->id)->where('event_id', $event->id)->count() > 0){
                $applied = true;
            } else {
                $applied = false;
            }
        }

        return view('pages.event-detail', [
            'event' => $event,
            'applied' => $applied
        ]);
    }

    // Apply event
    public function postEventApply(Request $r)
    {
        $data = [
            'status' => 'pending',
            'message' => $r->content,
            'event_id' => $r->event_id,
            'user_id' => Auth::user()->id,
        ];
        // Create application in db
        $application = Applicant::create($data);

        /* Send email to event hoster
        ***
        */
        $to_name = $application->event->user->name;
        $to_email = $application->event->user->email;
        $body = "You have received a new application from " . $application->user->name . " go check it out via the button below";
        $data = array('name'=>$to_name, "body" => $body, "sender_message" => $r->content);

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('New application!');
            $message->from('gigfinder.ahs@gmail.com','Gigfinder');
        });

        /*
        *** Send email to applicant
        */
        $to_name = $application->user->name;
        $to_email = $application->user->email;
        $body = "You applied for the " . $application->event->name . " event.";
        $sender_message = "You will receive an email once the host replies";

        $data = array('name'=>$to_name, "body" => $body, "sender_message" => $sender_message);

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('New application!');
            $message->from('gigfinder.ahs@gmail.com','Gigfinder');
        });
        return redirect()->back()->with('success', 'Application sent!');
    }

}
