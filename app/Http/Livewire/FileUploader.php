<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
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
    }
    public function save()
    {
        $this->validate([
            'photos.*' => 'image|max:1624', // 2.5MB Max
        ]);
        foreach ($this->photos as $photo) {
            $user_id = Auth::id();
            $photo->storePublicly('photos/' . $user_id . '/', 's3');
        }

    }


    public function render()
    {
        $user_id = Auth::id();

        $photo_files = Storage::disk('s3')->allFiles('photos/' . $user_id);
        // dd($files);
        return view('livewire.file-uploader', [
            'photo_files' => $photo_files
        ]);
    }
}
