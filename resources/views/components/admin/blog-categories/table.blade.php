<div id="blog-categories-table"
    x-data="{ deleteAction: '' }"
    data-search-url="{{ route('admin.blog-categories.search') }}">

    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.blog-categories.create') }}"
            class="bg-brand-500 hover:bg-brand-600 inline-flex items-center gap-2 rounded-lg px-4 py-2.5 text-sm font-medium text-white transition">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
            Add New
        </a>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

        {{-- Filters --}}
        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
            <div class="flex flex-wrap items-center justify-end gap-3">
                <input id="blog-category-search" type="search" value="{{ $search }}"
                    placeholder="Search name..."
                    class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full max-w-xs rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
            </div>
        </div>

        {{-- Results (replaced by AJAX) --}}
        <div id="blog-categories-results">
            @include('components.admin.blog-categories.partials.results', ['blogCategories' => $blogCategories])
        </div>

    </div>

    <x-ui.modal class="max-w-sm p-6" :show-close-button="false" @open-delete-modal.window="open = true">

        <div class="mb-4 flex justify-center">
            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-50 dark:bg-red-500/15">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" class="text-red-500">
                    <path d="M12 9v4M12 17h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>

        <h4 class="mb-2 text-center text-base font-semibold text-gray-800 dark:text-white/90">Delete Blog Category?</h4>
        <p class="mb-6 text-center text-theme-sm text-gray-500 dark:text-gray-400">Are you sure you want to delete this blog category?</p>

        <div class="flex items-center gap-3">
            <button @click="open = false" type="button"
                class="flex-1 rounded-lg border border-gray-200 px-4 py-2.5 text-theme-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.03]">
                Cancel
            </button>
            <form :action="deleteAction" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full rounded-lg bg-red-500 px-4 py-2.5 text-theme-sm font-medium text-white transition hover:bg-red-600">
                    Yes, Delete
                </button>
            </form>
        </div>

    </x-ui.modal>

</div>
