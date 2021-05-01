    <div
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
        {{-- upload form  --}}
        <div class="row m-form-group">
            <div class="col-4">
                <label for="coverphoto">Coverphoto</label>
            </div>
            <div class="col-8">
                <input type="file" name="coverphoto" id="" wire:model="photo"  accept="image/*" required>
                @error('photo') <span class="error">{{ $message }}</span> @enderror

                <input type="hidden" value="{{ $photo_path }}"name="coverphoto_path">

            </div>
            <div wire:loading wire:target="photo">Loading...</div>
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>

            {{-- upload preview --}}
            @if(strlen($photo_path) > 0 )

                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="coverphoto">Preview</label>
                    </div>
                    <div class="col-8">
                        @if(env('STORAGE') == 'public')
                            <img src="{{ asset($photo_path) }}" alt="" class="a-create-event-image">
                        @endif
                        @if(env('STORAGE') == 's3')
                            <img src="{{ env('AWS_URL') . $photo_path }}" alt="" class="a-create-event-image">
                        @endif
                    </div>
                </div>
            @endif
            {{-- Tried checking if file exists but it alway returned false --}}
            {{-- {{ var_dump(file_exists(public_path($coverphoto))) }}
            {{ var_dump(file_exists(asset($coverphoto))) }}
            {{ var_dump(file_exists(env('AWS_URL') . $coverphoto)) }} --}}
            @if (strlen($photo_path) == null)
                <div class="row m-form-group">
                    <div class="col-4">
                        <label for="coverphoto">Preview</label>
                    </div>
                    <div class="col-8">
                        @if(env('STORAGE') == 'public')
                            <img src="{{ asset($coverphoto) }}" alt="" class="a-create-event-image">
                        @endif
                        @if(env('STORAGE') == 's3')
                            <img src="{{ env('AWS_URL') . $coverphoto }}" alt="" class="a-create-event-image">
                        @endif
                    </div>
                </div>
                @endif
        </div>

    </div>




