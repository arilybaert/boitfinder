
<div class="row o-media"
x-data="{ isUploading: false, progress: 0 }"
x-on:livewire-upload-start="isUploading = true"
x-on:livewire-upload-finish="isUploading = false"
x-on:livewire-upload-error="isUploading = false"
x-on:livewire-upload-progress="progress = $event.detail.progress"
>
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
        @if (!$errors->any())
            @if ($photos)
                @foreach ($photos as $photo)
                    <div class="col-3 o-photos">

                        <img src="{{ $photo->temporaryUrl() }}">
                    </div>
                @endforeach
            @endif
        @endif

        @foreach ($photo_files as $photo_file)
                    <div class="col-3 o-photos">

                        <img src="{{env('AWS_URL') . $photo_file}}">
                    </div>
                @endforeach
    </div>


    <div wire:loading wire:target="photo">Loading...</div>
    <div wire:loading wire:target="save">Uploading to storage...</div>



    <button wire:click.prevent="save">Save</button>

    <!-- Progress Bar -->
    <div x-show="isUploading">
        <progress max="100" x-bind:value="progress"></progress>
    </div>
</div>
