<x-layouts.app :title="$title">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Tambah Member</h1>
            <div class="flex gap-2">
                <a href="{{ route('membership') }}" class="btn btn-secondary">
                    <i class="fas fa-backward fa-fw"></i>
                    Kembali
                </a>
            </div>
        </div>

        @if ($errors->has('error'))
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card bg-base-200 p-5 w-full max-w-sm mx-auto">
            <form id="form_registrasi" method="POST" action="{{ route('membership.store') }}"
                enctype="multipart/form-data">
                @csrf
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Nama Member</legend>
                    <input type="text" class="input w-full" id="name" placeholder="Masukan Nama Member" name="name" />
                    @error('name')
                        <div class="text-error ml-2">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Jenis Kelamin</legend>
                    <select class="select w-full" id="gender" name="gender">
                        <option value="{{ \App\GenderType::MALE->value }}">
                            {{ \App\GenderType::MALE->label() }}
                        </option>
                        <option value="{{ \App\GenderType::FEMALE->value }}">
                            {{ \App\GenderType::FEMALE->label() }}
                        </option>
                    </select>
                    @error('gender')
                        <div class="text-error ml-2">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Tipe Member</legend>
                    <select class="select w-full" id="member_type" name="member_type" required>
                        <option value="{{ \App\MemberType::PENGHUNI->value }}">
                            {{ \App\MemberType::PENGHUNI->label() }}
                        </option>
                        <option value="{{ \App\MemberType::NON_PENGHUNI->value }}">
                            {{ \App\MemberType::NON_PENGHUNI->label() }}
                        </option>
                    </select>
                    @error('member_type')
                        <div class="text-error ml-2">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Paket Membership</legend>
                    <select class="select w-full" id="gym_package_id" name="gym_package_id" required>
                        <option selected>Pilih Paket</option>
                        @foreach ($gym_packages as $gym_package)
                            <option value="{{ $gym_package->id }}">
                                {{ $gym_package->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('gym_package_id')
                        <div class="text-error ml-2">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Tanggal Join</legend>
                    <div class="relative">
                        <input type="date" class="input w-full pr-10" id="join_date" name="join_date" />
                        <span class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                    </div>
                    @error('join_date')
                        <div class="text-error ml-2">{{ $message }}</div>
                    @enderror
                </fieldset>


                <fieldset class="fieldset">
                    <legend class="fieldset-legend">No WhatsApp</legend>
                    <div class="join">
                        <div
                            class="join-item rounded-l-full border py-2 px-4 flex items-center bg-secondary text-white font-bold">
                            <span class="mt-0.5">08</span>
                        </div>
                        <input type="tel" class="input join-item" id="no_whatsapp" name="no_whatsapp" />
                    </div>
                    @error('no_whatsapp')
                        <div class="text-error ml-2">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="fieldset" id="group_kartu_identitas">
                    <label class="fieldset-legend" for="kartu_identitas_file">Kartu Identitas</label>
                    <input type="file" id="kartu_identitas_file" name="kartu_identitas_file" class="file-input w-full"
                        accept="image/*" capture="environment" />
                    @error('kartu_identitas_file')
                        <div class="text-error ml-2">{{ $message }}</div>
                    @enderror
                </fieldset>

                <hr class="my-4 border-t border-secondary" />

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Email</legend>
                    <input type="email" class="input w-full" id="email" name="email"
                        placeholder="Masukan Email Member" />
                    @error('email')
                        <div class="text-error ml-2">{{ $message }}</div>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Password</legend>
                    <div class="join" x-data="{ showPassword: false }">
                        <input :type="showPassword ? 'text' : 'password'" class="input w-full rounded-l-full"
                            id="password" name="password" />
                        <div class="validator-hint hidden">xxxx</div>
                        <button type="button" class="btn btn-neutral join-item" @click="showPassword = !showPassword">
                            <i class="fas fa-eye fa-fw" x-show="showPassword"></i>
                            <i class="fas fa-eye-slash fa-fw" x-show="!showPassword"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-error ml-2">{{ $message ?? '-' }}</div>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Konfirmasi Password</legend>
                    <div class="join" x-data="{ showPassword: false }">
                        <input :type="showPassword ? 'text' : 'password'" class="input w-full rounded-l-full"
                            id="password_confirmation" name="password_confirmation" />
                        <div class="validator-hint hidden">xxxx</div>
                        <button type="button" class="btn btn-neutral join-item" @click="showPassword = !showPassword">
                            <i class="fas fa-eye fa-fw" x-show="showPassword"></i>
                            <i class="fas fa-eye-slash fa-fw" x-show="!showPassword"></i>
                        </button>
                    </div>
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Status Member</legend>
                    <select class="select w-full" id="status" name="status">
                        <option value="active">Aktif</option>
                        <option value="expired">Expired</option>
                        <option value="new">New</option>
                    </select>
                    @error('status')
                        <div class="text-error ml-2">{{ $message }}</div>
                    @enderror
                </fieldset>

                <button type="submit" class="btn btn-primary w-full mt-4">Simpan</button>
            </form>
        </div>


    </div>

    @push('scripts')
        <script>
            const member_type = document.getElementById('member_type');
            member_type.addEventListener('change', function () {
                member_type_value = member_type.value;

                if (member_type_value == 'penghuni') {
                    document.getElementById('kartu_identitas_file').required = true;
                    document.getElementById('group_kartu_identitas').classList.remove('hidden');
                    document.getElementById('group_kartu_identitas').classList.add('block');
                } else {
                    document.getElementById('kartu_identitas_file').required = false;
                    document.getElementById('group_kartu_identitas').classList.remove('block');
                    document.getElementById('group_kartu_identitas').classList.add('hidden');
                }

                fetch(`{{ route('home.gym_package') }}?member_type=${member_type_value}`).then(response => response
                    .json()).then(data => {
                        let gym_package_id = document.getElementById('gym_package_id');
                        gym_package_id.innerHTML = '<option selected>Pilih Paket</option>';
                        if (data.length > 0) {
                            gym_package_id.disabled = false;
                            data.forEach(element => {
                                gym_package_id.innerHTML +=
                                    `<option value="${element.id}">${element.name} (Rp.${number_format(element.price)})</option>`;
                            });
                        } else {
                            gym_package_id.disabled = true;
                        }
                    });
            })

            function number_format(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            let form_registrasi = document.getElementById('form_registrasi');
            form_registrasi.addEventListener('submit', function (e) {
                e.preventDefault();

                let formData = new FormData();
                formData.append('email', document.getElementById("email").value);
                formData.append('password', document.getElementById("password").value);
                formData.append('password_confirmation', document.getElementById("password_confirmation").value);
                formData.append('name', document.getElementById("name").value);
                formData.append('gender', document.getElementById("gender").value);
                formData.append('member_type', document.getElementById("member_type").value);
                formData.append('gym_package_id', document.getElementById("gym_package_id").value);
                formData.append('no_whatsapp', "08" + document.getElementById("no_whatsapp").value);
                formData.append('kartu_identitas_file', document.getElementById("kartu_identitas_file").files[0]);


                Swal.fire({
                    title: 'Loading...',
                    html: 'Mohon tunggu sebentar...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
                $.ajax({
                    url: form_registrasi.action,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    contentType: false, // Tidak mengatur header Content-Type
                    processData: false, // Tidak memproses data menjadi string
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Loading...',
                            html: 'Mohon tunggu sebentar...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        })
                    },
                }).done(data => {
                    Swal.close()

                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `{{ route('membership') }}`;
                        }
                    })
                }).fail(e => {
                    Swal.close()
                    console.log("error", e.responseJSON.message);
                    // Handle error response
                    Swal.fire({
                        title: 'Error!',
                        text: e.responseJSON.message || 'Terjadi kesalahan!',
                        icon: 'error'
                    })
                })
            })
        </script>
    @endpush
</x-layouts.app>