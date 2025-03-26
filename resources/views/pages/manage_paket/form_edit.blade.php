<x-layouts.app :title="$title">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Edit Paket</h1>
            <div class="flex gap-2">
                <a href="{{ route('manage-paket') }}" class="btn btn-secondary">
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

        <livewire:form-edit-paket :gym_package="$gym_package" />

    </div>
</x-layouts.app>