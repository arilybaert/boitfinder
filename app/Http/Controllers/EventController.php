<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
            $future_events = Event::where('user_id', $user_id)->where('date', '>', $now)->get();
            $passed_events = Event::where('user_id', $user_id)->where('date', '<', $now)->get();
        }


        return view('pages.profile-event', [
            'future_events' => $future_events,
            'passed_events' => $passed_events,
        ]);
    }
    // edit event
    public function editEvent()
    {

    }
    // create event
    public function createEvent()
    {


        return view('pages.create-event');
    }
    // edit user-event profile
    public function editProfileEvent()
    {

        return view('pages.profile');
    }
    // change password user-event
    public function changePassword()
    {

        return view('pages.password');
    }
    // show all user-event media
    public function getEventMedia()
    {

        return view('pages.media', [

        ]);
    }
}
