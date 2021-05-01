<?php

namespace App\Http\Controllers;

use App\Models\EventsGenre;
use App\Models\Pa;
use App\Models\Microphone;
use App\Models\MicrophonesUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getIndex()
    {
        return view('admin.home');
    }
    public function getUsers()
    {
        return view('admin.users', [
            'users' => User::where('deleted_at', '=', null)->get()
        ]);
    }
    public function editUsers(User $user)
    {
        return view('admin.users-edit', [
            'user' => $user
        ]);
    }
    public function postUsers(Request $r)
    {
        $data = [
            "name" => $r->name,
            "email" => $r->email,
            "website" => $r->website,
            "telephone" => $r->telephone,
            "address" => $r->address,
            "role" => $r->role,
            "city" => $r->city,
            "zipcode" => $r->zipcode,
            "description" => $r->description,
        ];
        $user = User::where('id', $r->id)->first();
        $user->update($data);
        return back();
    }
    public function deleteUsers(User $user)
    {
        $microphones_users = MicrophonesUser::where('user_id', $user->id)->get();
        foreach ($microphones_users as $microphones_user) {
            $microphones_user->delete();
        }
        foreach ($user->events as $event) {
            $events_genres = EventsGenre::where('event_id', $event->id)->get();
            foreach ($events_genres as $events_genre) {
                $events_genre->delete();
            }

            foreach ($event->applicants as $applicant) {
                $applicant->delete();
            }
            $event->delete();
        }
        $user->delete();

        return back();
    }
    public function activateUsers(User $user)
    {
        $data = [
            'deleted_at' => null,
        ];
        $user->update($data);
        return back();
    }

    // microphones
    public function getMicrophones()
    {
        return view('admin.microphones', [
            "microphones" => Microphone::all(),
        ]);
    }
    public function postMicrophones(Request $r)
    {
        $data = [
            "name" => $r->name
        ];
        Microphone::where('id', $r->id)->update($data);
        return back();
    }
    public function deleteMicrophones(Microphone $microphone)
    {
        MicrophonesUser::where('microphone_id', $microphone->id)->delete();
        // dd($mcrophone);
        $microphone->delete();
        return back();
    }
    // pa
    public function getPas()
    {
        return view('admin.pas', [
            "pas" => Pa::all(),
        ]);
    }
    public function postPas(Request $r)
    {
        $data = [
            "name" => $r->name
        ];
        Pa::where('id', $r->id)->update($data);
        return back();
    }
    public function deletePas(Pa $pa)
    {
        $users = User::where('pa_id', $pa->id)->get();
        foreach ($users as $user) {
            $user->update(['pa_id' => null]);
        }
        $pa->delete();
        return back();
    }
}
