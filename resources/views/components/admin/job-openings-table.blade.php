<div x-data="{ deleteAction: '' }">

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

        {{-- Search --}}
        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
            <form method="GET" action="{{ route('admin.job-openings.index') }}">
                <div class="flex justify-end items-center gap-3">
                    <input type="search" name="search" value="{{ $search }}"
                        placeholder="Search title, work type, status..."
                        class="w-full max-w-xs rounded-lg border border-gray-200 bg-transparent px-4 py-2 text-theme-sm text-gray-700 outline-none placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:text-gray-300 dark:placeholder:text-gray-600">
                    <button type="submit"
                        class="bg-brand-500 hover:bg-brand-600 rounded-lg px-4 py-2 text-theme-sm font-medium text-white transition">
                        Search
                    </button>
                    @if ($search)
                        <a href="{{ route('admin.job-openings.index') }}"
                            class="rounded-lg border border-gray-200 px-4 py-2 text-theme-sm font-medium text-gray-600 transition hover:bg-gray-50 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="max-w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">#</p>
                        </th>
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Title</p>
                        </th>
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Work Type</p>
                        </th>
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
                        </th>
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Created At</p>
                        </th>
                        <th class="px-5 py-3 text-left sm:px-6">
                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Actions</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobOpenings as $job)
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $job->id }}</p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                    {{ $job->title }}</p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $job->work_type }}</p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                @php
                                    $statusClass = match ($job->status) {
                                        'open' => 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-500',
                                        'closed' => 'bg-red-50 text-red-700 dark:bg-red-500/15 dark:text-red-500',
                                        default
                                            => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400',
                                    };
                                @endphp
                                <span
                                    class="inline-block rounded-full px-2 py-0.5 text-theme-xs font-medium {{ $statusClass }}">
                                    {{ ucfirst($job->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                    {{ $job->created_at?->format('d M Y') }}</p>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.job-openings.show', $job) }}"
                                        class="text-theme-xs font-medium text-brand-500 hover:text-brand-600">View</a>
                                    <a href="{{ route('admin.job-openings.edit', $job) }}"
                                        class="text-theme-xs font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">Edit</a>
                                    <button type="button"
                                        @click="deleteAction = '{{ route('admin.job-openings.destroy', $job) }}'; $dispatch('open-delete-modal')"
                                        class="text-theme-xs font-medium text-red-500 hover:text-red-600">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="px-5 py-10 text-center text-theme-sm text-gray-400 dark:text-gray-600">
                                No job openings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $jobOpenings->withQueryString()->links() }}

    </div>

    <x-ui.modal class="max-w-sm p-6" :show-close-button="false" @open-delete-modal.window="open = true">

        {{-- Warning icon --}}
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

        {{-- Text --}}
        <h4 class="mb-2 text-center text-base font-semibold text-gray-800 dark:text-white/90">Delete Job Opening?</h4>
        <p class="mb-6 text-center text-theme-sm text-gray-500 dark:text-gray-400">This job opening will be permanently
            deleted and cannot be recovered.</p>

        {{-- Buttons --}}
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
