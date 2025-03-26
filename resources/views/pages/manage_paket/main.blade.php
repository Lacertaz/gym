<x-layouts.app :title="$title">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Manage Paket</h1>
            <div class="flex gap-2">
                <a href="{{ route('manage-paket.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus fa-fw"></i>
                    Tambah Paket
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

        <form action="{{ route('manage-paket') }}" method="get" class="flex gap-2 mb-5">
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
                        <th>Nama Paket</th>
                        <th>Durasi</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gym_packages as $gym_package)
                        <tr>
                            <td class="text-nowrap flex justify-center gap-1">
                                <a href="{{ route('manage-paket.edit', $gym_package) }}" class="btn btn-sm btn-success"
                                    title="Edit Paket">
                                    <i class="fas fa-pencil"></i>
                                </a>
                                <button class="btn btn-sm btn-error"
                                    onclick="deleteGymPackage({{ $gym_package->id }}, '{{ $gym_package->name }}')"
                                    title="Hapus Paket">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $gym_package->id }}"
                                    action="{{ route('manage-paket.destroy', $gym_package) }}" method="post" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                            <td class="text-nowrap">{{ $gym_package->name }}</td>
                            <td class="text-nowrap">{{ $gym_package->duration }} Bulan</td>
                            <td class="text-nowrap">{{ number_format($gym_package->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            {{ $gym_packages->links('vendor.pagination.daisy') }}
        </div>
    </div>

    @push('scripts')
        <script>
            function deleteGymPackage(id, name) {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    html: `Kamu akan menghapus Paket<br/><b>${name}</b>?`,
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