<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileUploader extends Component
{
    use WithFileUploads;

    public $photos = [];

    public function updatedPhotos()
    {
        $this->validate([
            'photos.*' => 'image|max:1624', // 2MB Max
        ]);
        $this->validate([
            'photos.*' => 'image|max:1624', // 2.5MB Max
        ]);
        foreach ($this->photos as $photo) {
            $user_id = Auth::id();
            $photo->storePublicly('photos/' . $user_id . '/', 's3');
        }
    }
    // public function save()
    // {

    // }
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

        $photo_files = Storage::disk('s3')->allFiles('photos/' . $user_id);
        // dd($photo_files[0]);
        return view('livewire.file-uploader', [
            'photo_files' => $photo_files,
            'user' => $user
        ]);
    }
}
