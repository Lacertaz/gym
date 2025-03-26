<x-layouts.landing>
    <div class="container mt-17 min-h-screen">

        <div class="p-4 mx-auto lg:py-16 format lg:format-lg text-black format-red">
            <h1 class="text-3xl font-bold text-center">Terimakasih telah mendaftar</h1>
            <p class="mt-4 text-center">Admin akan menghungi anda 1x24 jam. Jika ada pertanyaan bisa hubungi kami di
                nomor WhatsApp:</p>
            <p class="text-center">
                <a href={{ config('app.admin_wa_link') }} class="text-blue-500 hover:underline text-2xl">
                    <i class="fab fa-whatsapp"></i>
                    {{ config('app.admin_wa') }}
                </a>
            </p>
        </div>

    </div>
</x-layouts.landing>
