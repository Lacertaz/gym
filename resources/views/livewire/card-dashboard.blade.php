@props(['title', 'value'])

<div class="card bg-base-100 image-full shadow-sm h-full w-full">
    <div class="card-body flex justify-center items-center flex-col gap-2 group">
        <div>
            <h2
                class="text-center font-bold text-7xl text-accent dark:text-white group-hover:scale-110 transition-all duration-200">
                {{ $value }}
            </h2>
        </div>
        <div>
            <p class="text-center text-sm text-accent dark:text-white">{{ $title }}</p>
        </div>
    </div>
</div>