<x-layouts.app :title="$title">
    @vite(['resources/css/tiptap.css', 'resources/js/tiptap.js'])

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Info Gym</h1>
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

        <form method="POST" action="{{ route('info-gym.update') }}" class="flex flex-col gap-4">
            @csrf
            <textarea id="description" name="description" class="max-w-none"
                placeholder="Deskripsi">{{ $description }}</textarea>
            @error('description')
                <div class="fieldset-label text-error">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary w-full mt-4">Simpan</button>
        </form>
    </div>

    @push('scripts')
        <script src="https://cdn.tiny.cloud/1/{{ config('app.tinymce_api_key') }}/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: 'textarea#description', // Replace this CSS selector to match the placeholder element for TinyMCE
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table',
            });
        </script>
    @endpush
</x-layouts.app>
