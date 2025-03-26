<x-layouts.app :title="$title">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Manage Admin</h1>
            <div class="flex gap-2">
                <a href="{{ route('manage-admin.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus fa-fw"></i>
                    Tambah Admin
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

        <form action="{{ route('manage-admin') }}" method="get" class="flex gap-2 mb-5">
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
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td class="text-nowrap flex justify-center gap-1">
                                <a href="{{ route('manage-admin.edit', $admin) }}" class="btn btn-sm btn-success"
                                    title="Edit Admin">
                                    <i class="fas fa-pencil"></i>
                                </a>
                                <button class="btn btn-sm btn-error"
                                    onclick="deleteAdmin({{ $admin->id }}, '{{ $admin->name }}')" title="Hapus Admin">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $admin->id }}" action="{{ route('manage-admin.destroy', $admin) }}"
                                    method="post" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-sm btn-info"
                                    onclick="showResetModal({{ $admin->id }}, '{{ $admin->email }}')">
                                    <i class="fas fa-key"></i>
                                </button>
                            </td>
                            <td class="text-nowrap">{{ $admin->email }}</td>
                            <td class="text-nowrap">{{ $admin->name }}</td>
                            <td class="text-nowrap">{{ strtoupper($admin->role_name) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            {{ $admins->links('vendor.pagination.daisy') }}
        </div>

        @push('modal')
            <dialog id="modal_reset_password" class="modal !z-0">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                            <i class="fas fa-times"></i>
                        </button>
                    </form>

                    <form id="form_reset_password">
                        <h3 class="text-lg font-bold">Reset Password</h3>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Email</legend>
                            <input type="email" class="input input-ghost w-full readonly" placeholder="Masukan Email Member"
                                id="email" name="email" readonly />
                            <div id="email_error" class="text-error ml-2"></div>
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Password</legend>
                            <div class="join" x-data="{ showPassword: false }">
                                <input :type="showPassword ? 'text' : 'password'" class="input w-full rounded-l-full"
                                    id="password" name="password" required />
                                <div class="validator-hint hidden">xxxx</div>
                                <button type="button" class="btn btn-neutral join-item"
                                    @click="showPassword = !showPassword">
                                    <i class="fas fa-eye fa-fw" x-show="showPassword"></i>
                                    <i class="fas fa-eye-slash fa-fw" x-show="!showPassword"></i>
                                </button>
                            </div>
                            <div id="password_error" class="text-error ml-2"></div>
                        </fieldset>
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Konfirmasi Password</legend>
                            <div class="join" x-data="{ showPassword: false }">
                                <input :type="showPassword ? 'text' : 'password'" class="input w-full rounded-l-full"
                                    id="password_confirmation" name="password_confirmation" required />
                                <div class="validator-hint hidden">xxxx</div>
                                <button type="button" class="btn btn-neutral join-item"
                                    @click="showPassword = !showPassword">
                                    <i class="fas fa-eye fa-fw" x-show="showPassword"></i>
                                    <i class="fas fa-eye-slash fa-fw" x-show="!showPassword"></i>
                                </button>
                            </div>
                        </fieldset>
                        <div class="flex justify-end mt-3">
                            <input type="hidden" id="user_id" name="user_id" />
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </form>
                </div>
            </dialog>
        @endpush
    </div>

    @push('scripts')
        <script>
            let temp_user_id = null;

            window.onload = () => {
                document.getElementById("form_reset_password").addEventListener("submit", function (e) {
                    e.preventDefault();
                    fetch(`/manage-admin/reset-password/${temp_user_id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            email: document.getElementById("email").value,
                            password: document.getElementById("password").value,
                            password_confirmation: document.getElementById("password_confirmation").value,
                        })
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
                            console.log("data", data);
                            // Handle success response
                            document.getElementById("modal_reset_password").close();
                            Swal.fire({
                                title: 'Success!',
                                text: data.success,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });

                            document.getElementById("email").value = '';
                            document.getElementById("password").value = '';
                            document.getElementById("password_confirmation").value = '';
                        })
                        .catch(error => {
                            console.log("error", error);
                            // Handle error response
                            if (error.errors) {
                                const errors = error.errors;
                                for (const key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        const errorMessage = errors[key].join(', ');
                                        console.log(key);
                                        document.querySelector(`input[name="${key}"]`).classList.add('input-error');
                                        document.querySelector(`#${key}_error`).innerText =
                                            errorMessage;
                                    }
                                }
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An unexpected error occurred. Please try again.',
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    target: '#modal_reset_password'
                                });
                            }
                        });
                });
            }

            function showResetModal(id, email) {
                document.getElementById("modal_reset_password").showModal();
                temp_user_id = id;
                document.getElementById("email").value = email;
            }

            function deleteAdmin(id, name) {
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    html: `Kamu akan menghapus Admin<br/><b>${name}</b>?`,
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