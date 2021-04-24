<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileUploader extends Component
{
    use WithFileUploads;

    public $photos = [];
    public $songs = [];
    public $rider;

    public function updatedPhotos()
    {
        $this->validate([
            'photos.*' => 'image|max:2624', // 2MB Max
        ]);

        foreach ($this->photos as $photo) {
            $user_id = Auth::id();
            $photo->storePublicly('photos/' . $user_id . '/', 's3');
        }
    }
    public function updatedSongs()
    {
        $this->validate([
            'songs.*' => 'mimes:mp3|max:4100', // 4MB Max
        ]);
        foreach ($this->songs as $song) {
            $user_id = Auth::id();
            $song->storePublicly('songs/' . $user_id . '/', 's3');
        }
    }
    public function updatedRider()
    {
        $this->validate([
            'rider' => 'mimes:jpg,jpeg,png,svg,pdf|max:2324', // 2MB Max
        ]);

            $user_id = Auth::id();
            $this->rider->storePublicly('doc/rider/' . $user_id . '/', env('STORAGE'));
            $data = [
                'rider' => 'doc/rider/' . $user_id . '/' . $this->rider->hashname(),
            ];

            $user = User::findOrFail($user_id);
            Storage::disk(env('STORAGE'))->delete($user->rider);

            $user->update($data);
            return redirect()->to(route('event.media'));

    }
    public function removeRider($file)
    {
        $user_id = Auth::id();
        $data = [
            'rider' => '',
        ];
        $user = User::findOrFail($user_id);

        $user->update($data);
        Storage::disk(env('STORAGE'))->delete($file);
        return redirect()->to(route('event.media'));


    }
    public function remove($file)
    {
        Storage::disk('s3')->delete($file);

    }

    public function set($file)
    {
        $user = Auth::user();
        $data = [
            'coverphoto' => $file
        ];
        $user = User::findOrFail($user->id);
        $user->update($data);
        return redirect()->to(route('event.media'));



    }

    public function render()
    {
        $user = Auth::user();
        $user_id = Auth::id();

        // $photo_files = Storage::disk('s3')->allFiles('photos/' . $user_id);
        $photo_files = [];
        // $song_files = Storage::disk('s3')->allFiles('songs/' . $user_id);
        $song_files = [];

        $rider_file = $user->rider;
        // dd($rider_file);
        return view('livewire.file-uploader', [
            'photo_files' => $photo_files,
            'song_files' => $song_files,
            'user' => $user,
            'rider_file' => $rider_file
        ]);
    }
}
