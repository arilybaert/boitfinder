<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class CoverphotoUploader extends Component
{
    use WithFileUploads;

    public $photo;
    public $photo_path;

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:2624', // 2MB Max
        ]);
        $user_id = Auth::id();
        $this->photo->storePublicly('coverphotos/' . $user_id . '/', env('STORAGE'));
        $this->photo_path = 'coverphotos/' . $user_id . '/' . $this->photo->hashname();

    }

    public function render()
    {

        return view('livewire.coverphoto-uploader', [
            'photo_path' => $this->photo_path,
        ]);
    }
}
