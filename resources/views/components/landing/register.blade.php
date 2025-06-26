<section id="register" class="py-10">
    <h1 class="text-2xl font-bold text-center mb-4">Registrasi Member</h1>

    <form id="form_registrasi" action="{{ route('home.store') }}" class="max-w-md mx-auto">
        <div class="relative z-0 w-full mb-5 group">
            <input type="email" name="email" id="email"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="email"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Alamat Email
            </label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="password" name="password" id="password"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="password"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="password_confirmation"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Konfirmasi Passowrd
            </label>
        </div>

        <hr class="my-10 border-gray-200">

        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="name" id="name"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="name"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Nama Lengkap
            </label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <label for="gender" class="sr-only">Jenis Kelamin</label>
            <select id="gender" name="gender"
                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                <option value="" selected>Pilih Jenis Kelamin</option>
                <option value="{{ \App\GenderType::MALE->value }}">{{ \App\GenderType::MALE->label() }}</option>
                <option value="{{ \App\GenderType::FEMALE->value }}">{{ \App\GenderType::FEMALE->label() }}</option>
            </select>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <label for="member_type" class="sr-only">Jenis Member</label>
            <select id="member_type" name="member_type"
                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                <option selected>Pilih Jenis Member</option>
                <option value="{{ \App\MemberType::PENGHUNI->value }}">{{ \App\MemberType::PENGHUNI->label() }}</option>
                <option value="{{ \App\MemberType::NON_PENGHUNI->value }}">{{ \App\MemberType::NON_PENGHUNI->label() }}
                </option>
            </select>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <label for="gym_package_id" class="sr-only">Paket Gym</label>
            <select id="gym_package_id" name="gym_package_id"
                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer"
                disabled>
                <option selected>Pilih Paket</option>
            </select>
        </div>

        <div class="relative z-0 w-full mb-5 group">
            <label for="no_whatsapp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                WhatsApp</label>
            <div class="flex">
                <span
                    class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 font-bold">
                    08
                </span>
                <input type="tel" id="no_whatsapp" name="no_whatsapp"
                    class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
        </div>

        <div class="relative z-0 w-full mb-5 group" id="group_kartu_identitas">

            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="kartu_identitas_file">
                Kartu Identitas
            </label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="kartu_identitas_file" name="kartu_identitas_file" type="file" accept="image/*"
                capture="environment" />

        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>

</section>

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
                        window.location.href = `{{ route('home.success') }}`;
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