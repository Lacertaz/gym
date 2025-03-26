<x-layouts.app :title="$title">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Manage Carousel</h1>
            <div class="flex gap-2">
                <a href="{{ route('manage-carousel.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus fa-fw"></i>
                    Tambah Carousel
                </a>
            </div>
        </div>

        @if (session()->has('success'))
            <div class="toast toast-end z-50"
                x-data="{ showToast: true, type: 'success', message: '{{ session('success') }}' }"
                x-init="setTimeout(() => { $el.classList.add('animate-jump-out') }, 3000)">
                <div class="alert alert-success">
                    <span>
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </span>
                </div>
            </div>
        @endif

        <form action="{{ route('manage-carousel') }}" method="get" class="flex gap-2 mb-5">
            <label class="input">
                <i class="fas fa-search h-[1em] opacity-50"></i>
                <input type="search" id="keyword" name="keyword" placeholder="Cari Member" value="{{ $keyword }}" />
            </label>
        </form>

        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-200 mb-5">
            <table class="table table-compact table-pin-rows">
                <thead>
                    <tr>
                        <th class="text-center"><i class="fas fa-cogs"></i></th>
                        <th>Nama Carousel</th>
                        <th class="text-center">
                            <i class="fas fa-file-image"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($carousels->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center ">
                                Tidak ada data
                            </td>
                        </tr>
                    @endif
                    @foreach ($carousels as $carousel)
                        <tr>
                            <td>
                                <div class="flex items-center justify-center gap-1">
                                    <div>
                                        <a href="{{ route('manage-carousel.edit', $carousel) }}"
                                            class="btn btn-sm btn-success" title="Edit Carousel">
                                            <i class="fas fa-pencil"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-error"
                                            onclick="deleteCarousel({{ $carousel->id }}, '{{ $carousel->name }}')"
                                            title="Hapus Carousel">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <form id="delete-form-{{ $carousel->id }}"
                                            action="{{ route('manage-carousel.destroy', $carousel) }}" method="post"
                                            class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td class="text-nowrap">{{ $carousel->name }}</td>
                            <td>
                                <div class="flex items-center justify-center min-h-20">
                                    <img src="{{ asset('storage/' . $carousel->image) }}" alt="{{ $carousel->name }}"
                                        class="w-32 h-auto object-cover" lazy />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            {{ $carousels->links('vendor.pagination.daisy') }}
        </div>
    </div>

    @push('scripts')
        <script>
            function deleteCarousel(id, name) {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    html: `Kamu akan menghapus Carousel<br/><b>${name}</b>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                });
            }
        </script>
    @endpush
</x-layouts.app>