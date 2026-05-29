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
            @forelse($blogs as $blog)
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <td class="px-5 py-4 sm:px-6">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $blogs->firstItem() + $loop->index }}</p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">{{ $blog->title }}</p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $blog->category?->name ?? '-' }}</p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        @php
                            $statusClass = match ($blog->status) {
                                'published' => 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-500',
                                'draft'     => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400',
                                default     => 'bg-gray-50 text-gray-700 dark:bg-gray-500/15 dark:text-gray-400',
                            };
                        @endphp
                        <span class="inline-block rounded-full px-2 py-0.5 text-theme-xs font-medium {{ $statusClass }}">
                            {{ ucfirst($blog->status) }}
                        </span>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{ $blog->created_at?->format('d M Y') }}
                        </p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.blogs.show', $blog) }}"
                                class="text-theme-xs font-medium text-brand-500 hover:text-brand-600">View</a>
                            <a href="{{ route('admin.blogs.edit', $blog) }}"
                                class="text-theme-xs font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">Edit</a>
                            <button type="button"
                                @click="deleteAction = '{{ route('admin.blogs.destroy', $blog) }}'; $dispatch('open-delete-modal')"
                                class="text-theme-xs font-medium text-red-500 hover:text-red-600">Delete</button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-5 py-10 text-center text-theme-sm text-gray-400 dark:text-gray-600">
                        No blogs found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div data-pagination>
    {{ $blogs->withQueryString()->links() }}
</div>
