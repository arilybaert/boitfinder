<div>
    @error('photo') <span class="error">{{ $message }}</span> @enderror
    <input type="file" wire:model="photo">
    <button wire:click.prevent="save">Save</button>
</div>
