<div class="flex items-start max-md:flex-col">
    <div class="mr-10 w-full pb-4 md:w-[220px]">
        <nav class="flex flex-col overflow-visible min-h-auto">
            <a href="{{ route('settings.profile') }}" wire:navigate
                class=" hover:text-white border border-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Profile</a>
            <a href="{{ route('settings.password') }}" wire:navigate
                class=" hover:text-white border border-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Password</a>
        </nav>
    </div>

    <div class="flex-1 self-stretch max-md:pt-6">
        <h3 class="text-base font-bold">{{ $heading ?? '' }}</h3>
        <h4 class="text-base">{{ $subheading ?? '' }}</h4>

        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>