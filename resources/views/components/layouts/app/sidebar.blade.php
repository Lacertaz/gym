<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" data-theme="coffee">

<head>
    @include('partials.head', ['title' => $title])
    @livewireStyles
</head>

<body class="min-h-screen ">
    <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group heading="Menu" class="grid ">
                <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate class="mb-2">
                    {{ __('Dashboard') }}
                </flux:navlist.item>
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
                    <flux:navlist.item icon="user-group" :href="route('membership')"
                        :current="request()->routeIs('membership')" wire:navigate class="mb-2">
                        {{ __('Membership') }}
                    </flux:navlist.item>
                @endif
                <flux:navlist.item icon="bookmark" :href="route('extend-membership')"
                    :current="request()->routeIs('extend-membership')" wire:navigate class="mb-2">
                    {{ __('Extend Membership') }}
                </flux:navlist.item>
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
                    @if(auth()->user()->hasRole('super_admin'))
                        <flux:navlist.item icon="user-circle" :href="route('manage-admin')"
                            :current="request()->routeIs('manage-admin')" wire:navigate class="mb-2">
                            {{ __('Manage Admin') }}
                        </flux:navlist.item>
                    @endif
                    <flux:navlist.item icon="rectangle-stack" :href="route('manage-paket')"
                        :current="request()->routeIs('manage-paket')" wire:navigate class="mb-2">
                        {{ __('Manage Paket') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="photo" :href="route('manage-carousel')"
                        :current="request()->routeIs('manage-carousel')" wire:navigate class="mb-2">
                        {{ __('Manage Carousel') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="home" :href="route('info-gym')" :current="request()->routeIs('info-gym')"
                        wire:navigate class="mb-2">
                        {{ __('Manage Info Gym') }}
                    </flux:navlist.item>
                @endif
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        <!-- Desktop User Menu -->
        <flux:dropdown position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down" class="text-white" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-white text-black dark:bg-black dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>Settings</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
                </flux:menu.item>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
    @livewireScripts

    @stack('modal')

    <script>
        document.addEventListener('livewire:load', function () {
            alert('Livewire is loaded and ready!');
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"
        integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stack('scripts')
</body>

</html>