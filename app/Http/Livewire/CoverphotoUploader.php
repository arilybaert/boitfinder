<?php

namespace App\Http\Livewire;

use App\Models\Event;
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
    public $coverphoto;

    // mount coverphoto variable from view
    public function mount($coverphoto)
    {
        $this->coverphoto = $coverphoto;
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:2624', // 2MB Max
        ]);
        //get user
        $user_id = Auth::id();
        //store img in db
        $this->photo->storePublicly('coverphotos/' . $user_id . '/', env('STORAGE'));
        if(strlen($this->coverphoto) > 0) {
            Storage::disk(env('STORAGE'))->delete($this->coverphoto);
        }

        $this->photo_path = 'coverphotos/' . $user_id . '/' . $this->photo->hashname();

    }

    public function render()
    {

        return view('livewire.coverphoto-uploader', [
            'photo_path' => $this->photo_path,
            'coverphoto' => $this->coverphoto,
        ]);
    }
}
