@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden join">
            @if ($paginator->onFirstPage())
                <button class="join-item btn" aria-disabled="true" disabled>
                    {!! __('pagination.previous') !!}
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="join-item btn">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <button class="join-item btn" aria-disabled="true" disabled>
                    {!! __('pagination.next') !!}
                </button>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md join">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <button class="join-item btn" aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
                            disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn" rel="prev"
                            aria-label="{{ __('pagination.previous') }}">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">{{ $element }}</span>
                            </span>
                            <button class="join-item btn" aria-disabled="true" disabled>
                                {{ $element }}
                            </button>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <button class="join-item btn" aria-current="page" aria-disabled="true" disabled>
                                        {{ $page }}
                                    </button>
                                @else
                                    <a href="{{ $url }}" class="join-item btn"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="join-item btn"
                            aria-label="{{ __('pagination.next') }}">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <button class="join-item btn" aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                            disabled>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
