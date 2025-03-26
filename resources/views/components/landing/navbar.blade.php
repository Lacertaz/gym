@php
$logo_url = route('home');
    if (request()->routeIs('home')) {
    $logo_url = "#";
    }
@endphp
<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4" x-data="{ info: false, register: false }">
        <a href="{{ $logo_url }}" class="flex items-center space-x-3 rtl:space-x-reverse" @click="info=false,register=false">
            {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo"> --}}
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                {{ config('app.name') }}
            </span>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <a href="{{ route('login') }}"
                class="text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 group">

                <i class="fa-solid fa-right-to-bracket group-hover:animate-pulse group-hover:animate-infinite"></i>
                Login
            </a>
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-primary-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-primary-500 dark:focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Buka main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a id="info_link" href="#info"
                        class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-primary-400 md:hover:bg-transparent md:hover:text-primary-400 md:p-0 md:dark:hover:text-primary-500 dark:text-white dark:hover:bg-primary-400 dark:hover:text-primary-400 md:dark:hover:bg-transparent dark:border-gray-700 "
                        @click="info = true, register = false" :class="{ 'text-primary-500': info }" aria-current="page">Info Paket</a>
                </li>
                <li>
                    <a id="register_link" href="#register"
                        class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-primary-400 md:hover:bg-transparent md:hover:text-primary-400 md:p-0 md:dark:hover:text-primary-500 dark:text-white dark:hover:bg-primary-400 dark:hover:text-primary-400 md:dark:hover:bg-transparent dark:border-gray-700" @click="register = true, info = false" :class="{ 'text-primary-500': register }">Pendaftaran</a>
                </li>
                <li>
                    <a href="{{ config('app.admin_wa_link') }}"
                        class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-primary-400 md:hover:bg-transparent md:hover:text-primary-400 md:p-0 md:dark:hover:text-primary-500 dark:text-white dark:hover:bg-primary-400 dark:hover:text-primary-400 md:dark:hover:bg-transparent dark:border-gray-700">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
