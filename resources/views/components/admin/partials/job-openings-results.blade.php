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
                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Work Type</p>
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
            @forelse($jobOpenings as $job)
                <tr class="border-b border-gray-100 dark:border-gray-800">
                    <td class="px-5 py-4 sm:px-6">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $job->id }}</p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">{{ $job->title }}</p>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        @php
                            $workTypeClass = match ($job->work_type) {
                                'remote' => 'bg-blue-50 text-blue-700 dark:bg-blue-500/15 dark:text-blue-400',
                                'wfa'    => 'bg-purple-50 text-purple-700 dark:bg-purple-500/15 dark:text-purple-400',
                                'wfo'    => 'bg-orange-50 text-orange-700 dark:bg-orange-500/15 dark:text-orange-400',
                                'hybrid' => 'bg-teal-50 text-teal-700 dark:bg-teal-500/15 dark:text-teal-400',
                                default  => 'bg-gray-50 text-gray-700 dark:bg-gray-500/15 dark:text-gray-400',
                            };
                        @endphp
                        <span class="inline-block rounded-full px-2 py-0.5 text-theme-xs font-medium {{ $workTypeClass }}">
                            {{ strtoupper($job->work_type) }}
                        </span>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        @php
                            $statusClass = match ($job->status) {
                                'open'   => 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-500',
                                'closed' => 'bg-red-50 text-red-700 dark:bg-red-500/15 dark:text-red-500',
                                default  => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400',
                            };
                        @endphp
                        <span class="inline-block rounded-full px-2 py-0.5 text-theme-xs font-medium {{ $statusClass }}">
                            {{ ucfirst($job->status) }}
                        </span>
                    </td>
                    <td class="px-5 py-4 sm:px-6">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                            {{ $job->created_at?->format('d M Y') }}
                        </p>
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
                    <td colspan="6" class="px-5 py-10 text-center text-theme-sm text-gray-400 dark:text-gray-600">
                        No job openings found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div data-pagination>
    {{ $jobOpenings->withQueryString()->links() }}
</div>
