<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

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
            $photo->storePublicly('photos/jens', 's3');
        }

    }


    public function render()
    {
        return view('livewire.file-uploader');
    }
}
