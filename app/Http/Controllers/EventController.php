<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getIndex()
    {
        return view('event.home');
    }
    // show all events from event-user
    public function getEvents()
    {

        return view('pages.profile-event', [

        ]);
    }
    // edit event
    public function editEvent()
    {

    }
    // create event
    public function createEvent()
    {

    }
    // edit user-event profile
    public function editProfileEvent()
    {

    }
    // change password user-event
    public function changePassword()
    {

    }
    // show all user-event media
    public function getEventMedia()
    {

    }
}
