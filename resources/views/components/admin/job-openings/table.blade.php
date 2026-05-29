<div id="job-openings-table"
    x-data="{ deleteAction: '' }"
    data-search-url="{{ route('admin.job-openings.search') }}">

    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.job-openings.create') }}"
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
                {{-- Search --}}
                <input id="job-search" type="search" value="{{ $search }}"
                    placeholder="Search title..."
                    class="w-full max-w-xs rounded-lg border border-gray-200 bg-transparent px-4 py-2 text-theme-sm text-gray-700 outline-none placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:text-gray-300 dark:placeholder:text-gray-600" />

                {{-- Work Type --}}
                <select id="job-work-type"
                    class="rounded-lg border border-gray-200 bg-transparent px-4 py-2 text-theme-sm text-gray-700 outline-none focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                    <option value="">All Work Types</option>
                    @foreach (['remote' => 'Remote', 'wfa' => 'WFA', 'wfo' => 'WFO', 'hybrid' => 'Hybrid'] as $value => $label)
                        <option value="{{ $value }}" {{ $workType === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>

                {{-- Status --}}
                <select id="job-status"
                    class="rounded-lg border border-gray-200 bg-transparent px-4 py-2 text-theme-sm text-gray-700 outline-none focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                    <option value="">All Statuses</option>
                    <option value="open" {{ $status === 'open' ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ $status === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
        </div>

        {{-- Results (replaced by AJAX) --}}
        <div id="job-openings-results">
            @include('components.admin.job-openings.partials.results', ['jobOpenings' => $jobOpenings])
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

        <h4 class="mb-2 text-center text-base font-semibold text-gray-800 dark:text-white/90">Delete Job Opening?</h4>
        <p class="mb-6 text-center text-theme-sm text-gray-500 dark:text-gray-400">This job opening will be permanently
            deleted and cannot be recovered.</p>

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
