<footer class="bg-white rounded-lg shadow-sm mx-4 mt-10 mb-4 dark:bg-gray-800">
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ date('Y') }} <a
                href="https://flowbite.com/" class="hover:underline">{{ config('app.name') }}</a>. All Rights Reserved.
        </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
            <li>
                <a href="#info" class="hover:underline me-4 md:me-6">Info Paket</a>
            </li>
            <li>
                <a href="#register" class="hover:underline me-4 md:me-6">Pendaftaran</a>
            </li>
            <li>
                <a href="{{ config('app.admin_wa_link') }}" class="hover:underline me-4 md:me-6">Kontak</a>
            </li>
            <li>
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
            </li>
        </ul>
    </div>
</footer>
