<x-layouts.app :title="$title">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Edit Carousel</h1>
            <div class="flex gap-2">
                <a href="{{ route('manage-carousel') }}" class="btn btn-secondary">
                    <i class="fas fa-backward fa-fw"></i>
                    Kembali
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- <livewire:form-edit-carousel :carousel="$carousel" /> --}}

        <div class="card bg-base-200 p-5 w-full max-w-sm mx-auto">
            <form action="{{ route('manage-carousel.update', $carousel) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <fieldset class="fieldset">
                    <label class="fieldset-legend" for="name">Nama Carousel</label>
                    <input type="text" id="name" name="name" class="input w-full"
                        placeholder="Masukan Nama Carousel" value="{{ $carousel->name }}" required />
                    @error('name')
                        <div class="text-error ml-2">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <label class="fieldset-legend" for="image">Gambar</label>
                    <input type="file" id="image" name="image" class="file-input w-full" />
                    @error('name')
                        <div class="text-error ml-2">{{ $message }}</div>
                    @enderror
                </fieldset>

                <img id="preview" src="{{ asset('storage/' . $carousel->image) }}" class="mt-2 w-full h-auto">

                <button type="submit" class="btn btn-primary w-full mt-4">Simpan</button>
            </form>
        </div>

    </div>

    @push('scripts')
        <script>
            const imageInput = document.querySelector('#image');
            const imagePreview = document.querySelector('#preview');

            imageInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                const reader = new FileReader();
                reader.onload = () => {
                    imagePreview.src = reader.result;
                }
                reader.readAsDataURL(file);
            })
        </script>
    @endpush
</x-layouts.app>
