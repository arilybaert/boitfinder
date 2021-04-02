<?php

namespace App\Http\Controllers;

use App\Models\Pa;
use App\Models\User;
use App\Models\Event;
use App\Models\Microphone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EventController extends Controller
{
    public function getIndex()
    {
        return view('event.home');
    }
    // show all events from event-user
    public function getEvents()
    {
        $now = Carbon::now();
        if (Auth::check()){
            $user_id = Auth::id();
            $future_events = Event::where('user_id', $user_id)->where('date', '>', $now)->orderBy('date', 'asc')->get();
            $passed_events = Event::where('user_id', $user_id)->where('date', '<', $now)->orderBy('date', 'asc')->get();
        }


        return view('pages.profile.profile-event.profile-event', [
            'future_events' => $future_events,
            'passed_events' => $passed_events,
        ]);
    }
    // event applicants
    public function getEventApplicants(Event $event)
    {
        // dd($event);
        return view('pages.applicants', [
        'event' => $event
        ]);
    }
    public function acceptApplicant(Event $event, User $accepted_applicant)
    {
        foreach ($event->applicants as $applicant) {
            if($applicant->user->id == $accepted_applicant->id) {
                $applicant->update([['status' => 'accepted']]);
            } else {
                $applicant->update(['status' => 'rejected']);
            };

        }
        return back();
    }
    // edit event
    public function editEvent(Event $event)
    {


    }
    // create event
    public function createEvent(Event $event)
    {

        $pas = Pa::all();
        $microphones = Microphone::all();
        return view('pages.profile.profile-event.create-event', [
            'event' => $event,
            'microphones' => $microphones,
            'pas' => $pas
        ]);
    }
    // save event
    public function saveEvent(Request $r)
    {
        $event_data = [
            'name' => $r->name,
            'date' => $r->date,
            'description' => $r->description,
            'user_id' => Auth::id(),
            'genre_id' => 14
        ];
        if(Event::where('id',$r->id)) {
            $event = Event::where('id', $r->id)->first();
            $event->update($event_data);
        } else {
            $event = Event::create($event_data);

        }


        return back();

    }

    // edit user-event profile
    public function editProfileEvent()
    {
        $user = User::where('id', Auth::id())->first();

        return view('pages.profile.profile', [
            'user' => $user
        ]);
    }
    public function saveProfileEvent(Request $r)
    {
        $data = [
            'name' => $r->name,
            'telephone' => $r->telephone,
            'address' => $r->address,
            'zipcode' => $r->zipcode,
            'city' => $r->city,
            'website' => $r->website,
            'capacity' => $r->capacity,
            'description' => $r->description,
            'genre_description' => $r->genre_description,
        ];
        if($r->id){
            $user = User::where('id', $r->id)->first();
            $user->update($data);
        }
        return back();

    }
    // change password user-event
    public function changePassword()
    {

        return view('pages.profile.password');
    }
    // show all user-event media
    public function getEventMedia()
    {

        return view('pages.profile.media', [

        ]);
    }
}
