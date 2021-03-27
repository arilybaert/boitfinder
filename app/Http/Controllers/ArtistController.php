<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ArtistController extends Controller
{
        // Find event
    public function getFindArtist()
    {
        $artists = User::where('role', 'artist')->get();

        // dd($artists);
        // dd($events);
        return view('pages.find-artist', [
            'artists' => $artists,
        ]);
    }

    public function getArtist(User $artist)
    {

        return view('pages.artist-detail', [
            'artist' => $artist
        ]);
    }
}
