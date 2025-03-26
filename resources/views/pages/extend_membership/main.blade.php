<x-layouts.app :title="$title">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Extend Membership</h1>
            <div class="flex gap-2">
                <a href="{{ route('extend-membership.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus fa-fw"></i>
                    Tambah Extend Membership
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

        @if(!auth()->user()->hasRole('user'))
            <form action="{{ route('extend-membership') }}" method="get" class="flex gap-2 mb-5">
                <label class="input">
                    <i class="fas fa-search h-[1em] opacity-50"></i>
                    <input type="search" id="keyword" name="keyword" placeholder="Cari Member" value="{{ $keyword }}" />
                </label>
            </form>
        @endif

        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-200 mb-5">
            <table class="table table-compact table-pin-rows">
                <thead>
                    <tr>
                        @if(!auth()->user()->hasRole('user'))
                            <th class="text-center"><i class="fas fa-cogs"></i></th>
                        @endif
                        <th>Tanggal Request</th>
                        <th>Nama Member</th>
                        <th>Jenis Membership</th>
                        <th>Paket Extend</th>
                        <th>Durasi</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if($extend_memberships->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
                        </tr>
                    @endif
                    @foreach ($extend_memberships as $extend_membership)
                        <tr>
                            @if(!auth()->user()->hasRole('user'))
                                <td class="text-nowrap flex justify-center gap-1">
                                    @if($extend_membership->getRawOriginal('status') === App\LogMembershipStatusType::UNPAID->value)
                                        <button class="btn btn-sm btn-success"
                                            onclick="confirmApproveReject('{{ $extend_membership->id }}', '{{ $extend_membership->membership->user->name }}', 'approve')"
                                            title="TERIMA">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning"
                                            onclick="confirmApproveReject('{{ $extend_membership->id }}', '{{ $extend_membership->membership->user->name }}', 'reject')"
                                            title="TOLAK">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                </td>
                            @endif
                            <td class="text-nowrap">{{ $extend_membership->created_at }}</td>
                            <td class="text-nowrap">{{ $extend_membership->membership->user->name }}</td>
                            <td class="text-nowrap">{{ $extend_membership->membership->member_type->label() }}</td>
                            <td class="text-nowrap">{{ $extend_membership->gymPackage->name }}</td>
                            <td class="text-nowrap">{{ $extend_membership->duration }} Bulan</td>
                            <td class="text-nowrap">
                                @if($extend_membership->status->value == App\LogMembershipStatusType::PAID->value)
                                    {{ $extend_membership->start_date->format('d F Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-nowrap">
                                @if($extend_membership->status->value == App\LogMembershipStatusType::PAID->value)
                                    {{ $extend_membership->end_date->format('d F Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-nowrap">Rp. {{ number_format($extend_membership->price, 0, ',', '.') }}</td>
                            <td>
                                {!! $extend_membership->status_badge !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            {{ $extend_memberships->links('vendor.pagination.daisy') }}
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmApproveReject(id, name, type) {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    html: `Kamu akan ${type} member<br/><b>${name}</b>?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Ya, ${type}!`
                }).then((result) => {
                    if (result.isConfirmed) {
                        prosesApproveReject(id, type);
                    }
                });
            }

            function prosesApproveReject(id, type) {
                fetch(`/extend-membership/proses_approve_reject/${id}/${type}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(errorData => {
                                throw errorData;
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire({
                            title: 'Berhasil',
                            text: data.message,
                            icon: 'success'
                        }).then(() => {
                            location.reload(); // Reload the page to see the changes
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: error.message || 'Terjadi kesalahan!',
                            icon: 'error'
                        });
                    });
            }

            function deleteMembership(id, name) {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    html: `Kamu akan menghapus member<br/><b>${name}</b>?`,
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