<div
x-data="{ isUploading: false, progress: 0 }"
x-on:livewire-upload-start="isUploading = true"
x-on:livewire-upload-finish="isUploading = false"
x-on:livewire-upload-error="isUploading = false"
x-on:livewire-upload-progress="progress = $event.detail.progress"
>
    <div class="o-photo-uploader">
        @error('photo') <span class="error">{{ $message }}</span> @enderror

        {{ var_dump($photo_path) }}
        @if(strlen($photo_path) > 0)
            <img src="{{asset($photo_path)}}">
            <input type="hidden" value="{{ $photo_path }}" name="profile_picture">

        @else

        <div @click="$refs.photoInput.click()" class="m-add-btn">
            <i class="fas fa-plus"></i>
        </div>
        <input x-ref="photoInput" type="file" wire:model="photo" style="display: none;" accept="image/*">
        @endif
    </div>

    <div wire:loading wire:target="photo">Loading...</div>
    <div x-show="isUploading">
        <progress max="100" x-bind:value="progress"></progress>
    </div>
</div>

