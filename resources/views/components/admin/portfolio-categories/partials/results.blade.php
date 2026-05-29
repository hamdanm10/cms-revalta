<div class="max-w-full overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-100 dark:border-gray-800">
                <th class="px-5 py-3 text-left sm:px-6 text-nowrap">
                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">#</p>
                </th>
                <th class="px-5 py-3 text-left sm:px-6 text-nowrap">
                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Name</p>
                </th>
                <th class="px-5 py-3 text-left sm:px-6 text-nowrap">
                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Slug</p>
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
            @forelse($portfolioCategories as $category)
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <td class="px-5 py-4 sm:px-6">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $portfolioCategories->firstItem() + $loop->index }}</p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">{{ $category->name }}</p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <p class="font-mono text-theme-sm text-gray-500 dark:text-gray-400">{{ $category->slug }}</p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{ $category->created_at?->format('d M Y') }}
                        </p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.portfolio-categories.show', $category) }}"
                                class="text-theme-xs font-medium text-brand-500 hover:text-brand-600">View</a>
                            <a href="{{ route('admin.portfolio-categories.edit', $category) }}"
                                class="text-theme-xs font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">Edit</a>
                            <button type="button"
                                @click="deleteAction = '{{ route('admin.portfolio-categories.destroy', $category) }}'; $dispatch('open-delete-modal')"
                                class="text-theme-xs font-medium text-red-500 hover:text-red-600">Delete</button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-5 py-10 text-center text-theme-sm text-gray-400 dark:text-gray-600">
                        No portfolio categories found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div data-pagination>
    {{ $portfolioCategories->withQueryString()->links() }}
</div>
