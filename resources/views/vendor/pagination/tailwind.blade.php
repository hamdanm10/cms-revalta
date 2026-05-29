@if ($paginator->hasPages())
    <div class="flex items-center justify-between px-5 py-4 border-t border-gray-100 sm:px-6 dark:border-gray-800">
        <p class="text-theme-sm text-gray-500 dark:text-gray-400">
            @if ($paginator->firstItem())
                Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }} results
            @else
                {{ $paginator->count() }} results
            @endif
        </p>

        <div class="flex items-center gap-1">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span
                    class="inline-flex h-8 w-8 cursor-not-allowed items-center justify-center rounded-lg text-gray-300 dark:text-gray-700">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-500 transition hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-white/[0.05]">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            @endif

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span
                        class="inline-flex h-8 w-8 items-center justify-center text-gray-400 dark:text-gray-600">…</span>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-brand-500 text-theme-sm font-medium text-white">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-theme-sm text-gray-500 transition hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-white/[0.05]">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-500 transition hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-white/[0.05]">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            @else
                <span
                    class="inline-flex h-8 w-8 cursor-not-allowed items-center justify-center rounded-lg text-gray-300 dark:text-gray-700">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
            @endif
        </div>
    </div>
@endif
