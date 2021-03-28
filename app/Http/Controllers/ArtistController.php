<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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
    // download rider
    public function getRider()
    {
        // Storage::disk('local')->put('example.txt', 'Contents');
        return Storage::download('public/docs/artist-riders/rider.png');
    }
}
