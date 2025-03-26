<div class="card bg-base-200 p-5 w-full max-w-sm mx-auto">
    <form wire:submit.prevent="save">
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Nama Carousel</legend>
            <input type="text" class="input w-full" placeholder="Masukan Nama Carousel" wire:model="name" />
            @error('name')
                <div class="text-error ml-2">{{ $message }}</div>
            @enderror
        </fieldset>

        <div>
            <fieldset class="fieldset" x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <legend class="fieldset-legend">Gambar</legend>
                <input type="file" class="file-input w-full" wire:model="image" />
                @error('image')
                    <div class="text-error ml-2">{{ $message }}</div>
                @enderror
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress" class="progress progress-info"></progress>
                </div>
            </fieldset>
        </div>

        @if ($image)
            <img src="{{ $image->temporaryUrl() }}" class="mt-2 w-full h-auto">
        @endif

        <button type="submit" class="btn btn-primary w-full mt-4">Simpan</button>
    </form>
</div>