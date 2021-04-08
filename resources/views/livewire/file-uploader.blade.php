<div>
    @error('photos.*') <span class="error">{{ $message }}</span> @enderror

    <input type="file" multiple wire:model="photos">

    <div wire:loading wire:target="photo">Loading...</div>
    <div wire:loading wire:target="save">Uploading to storage...</div>

    @if (!$errors->any())
        @if ($photos)
            Photo Preview:
            @foreach ($photos as $photo)
                <img src="{{ $photo->temporaryUrl() }}" width="250px" height="100px" style="object-fit: cover">
            @endforeach
        @endif
    @endif

    <button wire:click.prevent="save">Save</button>
</div>
