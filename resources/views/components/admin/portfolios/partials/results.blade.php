<div class="max-w-full overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-100 dark:border-gray-800">
                <th class="px-5 py-3 text-left sm:px-6 text-nowrap">
                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">#</p>
                </th>
                <th class="px-5 py-3 text-left sm:px-6 text-nowrap">
                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Title</p>
                </th>
                <th class="px-5 py-3 text-left sm:px-6 text-nowrap">
                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Category</p>
                </th>
                <th class="px-5 py-3 text-left sm:px-6 text-nowrap">
                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p>
                </th>
                <th class="px-5 py-3 text-left sm:px-6 text-nowrap">
                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Created At</p>
                </th>
                <th class="px-5 py-3 text-left sm:px-6 text-nowrap">
                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Actions</p>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($portfolios as $portfolio)
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <td class="px-5 py-4 sm:px-6">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $portfolios->firstItem() + $loop->index }}</p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">{{ $portfolio->title }}</p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $portfolio->category?->name ?? '-' }}</p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        @php
                            $statusClass = match ($portfolio->status) {
                                'published' => 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-500',
                                'draft'     => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400',
                                default     => 'bg-gray-50 text-gray-700 dark:bg-gray-500/15 dark:text-gray-400',
                            };
                        @endphp
                        <span class="inline-block rounded-full px-2 py-0.5 text-theme-xs font-medium {{ $statusClass }}">
                            {{ ucfirst($portfolio->status) }}
                        </span>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{ $portfolio->created_at?->format('d M Y') }}
                        </p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.portfolios.show', $portfolio) }}"
                                class="text-theme-xs font-medium text-brand-500 hover:text-brand-600">View</a>
                            <a href="{{ route('admin.portfolios.edit', $portfolio) }}"
                                class="text-theme-xs font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">Edit</a>
                            <button type="button"
                                @click="deleteAction = '{{ route('admin.portfolios.destroy', $portfolio) }}'; $dispatch('open-delete-modal')"
                                class="text-theme-xs font-medium text-red-500 hover:text-red-600">Delete</button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-5 py-10 text-center text-theme-sm text-gray-400 dark:text-gray-600">
                        No portfolios found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div data-pagination>
    {{ $portfolios->withQueryString()->links() }}
</div>
