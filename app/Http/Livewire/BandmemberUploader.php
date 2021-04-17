<?php

namespace App\Http\Livewire;
use App\Models\Bandmember;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;


class BandmemberUploader extends Component
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
        $this->photo->store('img/bandmembers/' . $user_id . '/', 'public');

        $this->photo_path = 'storage/img/bandmembers/' . $user_id . '/' . $this->photo->hashname();
    }

    public function render()
    {
        return view('livewire.bandmember-uploader', [
            'photo_path' => $this->photo_path,
                ]);
    }
}
