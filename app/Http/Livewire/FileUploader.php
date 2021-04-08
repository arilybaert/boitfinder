<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploader extends Component
{
    use WithFileUploads;

    public $photo;

    public function save()
    {
        $this->validate([
            'photo' => 'image|max:5624', // 2.5MB Max
        ]);

        $this->photo->storePublicly('photos', 's3');
    }


    public function render()
    {
        return view('livewire.file-uploader');
    }
}
