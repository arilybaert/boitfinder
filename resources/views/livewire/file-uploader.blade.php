
<div class="row o-media"
x-data="{ isUploading: false, progress: 0 }"
x-on:livewire-upload-start="isUploading = true"
x-on:livewire-upload-finish="isUploading = false"
x-on:livewire-upload-error="isUploading = false"
x-on:livewire-upload-progress="progress = $event.detail.progress"
>

    {{-- upload photos  --}}
    <div class="row">
        <h2 class="col-6">
            Photo's
        </h2>
        <div class="col-6">
            <div @click="$refs.photoInput.click()" class="m-button-photos">
                <div class="a-button-photos">Add photo's</div>
            </div>
            <input x-ref="photoInput" type="file" multiple wire:model="photos" style="display: none;">
        </div>
    </div>

@error('photos.*') <span class="error">{{ $message }}</span> @enderror

    <div class="row">
        {{-- @if (!$errors->any())
            @if ($photos)
                @foreach ($photos as $photo)
                    <div class="col-3 o-photos">

                        <img src="{{ $photo->temporaryUrl() }}">
                    </div>
                @endforeach
            @endif
        @endif --}}

        @foreach ($photo_files as $photo_file)
            <div class="col-3 o-photos">

                <img src="{{env('AWS_URL') . $photo_file}}">
                <button wire:click.prevent="remove('{{$photo_file}}')" class="a-button-remove">
                    <i class="fas fa-minus-circle" accept="image/*"></i>
                </button>

                @if ($user->coverphoto !== $photo_file)

                    <button wire:click.submit="set('{{$photo_file}}')" class="a-button-coverphoto">
                        <i class="fas fa-home"></i>
                    </button>
                @endif

            </div>
        @endforeach
    </div>

    {{-- upload music  --}}
    @if (Auth::user()->role === 'artist')
        <div class="row o-songs">
            <h2 class="col-6">
                Songs
            </h2>
            @if (count($song_files) < 5)

                <div class="col-6">
                    <div @click="$refs.songInput.click()" class="m-button-photos">
                        <div class="a-button-photos">Add songs</div>
                    </div>
                    <input x-ref="songInput" type="file" multiple wire:model="songs" style="display: none;" accept="audio/*">
                </div>
            @endif

        </div>

        @error('songs.*') <span class="error">{{ $message }}</span> @enderror

        <div class="row">
            @foreach ($song_files as $song_file)
                <div class="col-6 o-photos">
                    <audio controls css="background-color:red;">
                        <source src="{{env('AWS_URL') . $song_file}}" type="audio/mpeg">
                      Your browser does not support the audio element.
                      </audio>

                </div>
                <div class="col-3 offset-3 m-song-remove">
                    <button wire:click.prevent="remove('{{$song_file}}')" class="a-button-remove">
                        Remove
                    </button>
                </div>
            @endforeach
        </div>

        <div class="row o-songs">
            <h2 class="col-6">
                Rider
            </h2>
                <div class="col-6">
                    <div @click="$refs.riderInput.click()" class="m-button-photos">
                        <div class="a-button-photos">Add Rider</div>
                    </div>
                    <input x-ref="riderInput" type="file" wire:model="rider" style="display: none;" accept="image/*, .pdf">
                </div>
        </div>

        @error('rider') <span class="error">{{ $message }}</span> @enderror

        <div class="row">
                <div class="col-6 o-photos">
                    @if ($rider_file !== '')
                        <img src="{{asset($rider_file)}}" alt="">
                    </div>
                    <div class="col-3 offset-3 m-song-remove">
                        <button wire:click.prevent="removeRider('{{$rider_file}}')" class="a-button-remove">
                            Remove
                        </button>
                    </div>
                    @endif
        </div>
    @endif

    <div wire:loading wire:target="photo">Loading...</div>
    <div wire:loading wire:target="save">Uploading to storage...</div>



    {{-- <button wire:click.prevent="save">Save</button> --}}

    <!-- Progress Bar -->
    <div x-show="isUploading">
        <progress max="100" x-bind:value="progress"></progress>
    </div>
</div>
