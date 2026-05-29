<div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

    {{-- Description Preview --}}
    <div class="xl:col-span-2">
        <x-common.component-card title="Description">
            <div class="quill-content">
                {!! $jobOpening->description !!}
            </div>
        </x-common.component-card>
    </div>

    {{-- Detail Info --}}
    <div class="space-y-6">
        <x-common.component-card title="Job Details">

            {{-- Title --}}
            <div>
                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Title</p>
                <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $jobOpening->title }}</p>
            </div>

            {{-- Short Description --}}
            <div>
                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Short Description</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $jobOpening->short_description }}</p>
            </div>

            {{-- Work Type --}}
            <div>
                <p class="mb-1.5 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Work Type</p>
                @php
                    $workTypeClass = match ($jobOpening->work_type) {
                        'remote' => 'bg-blue-50 text-blue-700 dark:bg-blue-500/15 dark:text-blue-400',
                        'wfa'    => 'bg-purple-50 text-purple-700 dark:bg-purple-500/15 dark:text-purple-400',
                        'wfo'    => 'bg-orange-50 text-orange-700 dark:bg-orange-500/15 dark:text-orange-400',
                        'hybrid' => 'bg-teal-50 text-teal-700 dark:bg-teal-500/15 dark:text-teal-400',
                        default  => 'bg-gray-50 text-gray-700 dark:bg-gray-500/15 dark:text-gray-400',
                    };
                @endphp
                <span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-medium {{ $workTypeClass }}">
                    {{ strtoupper($jobOpening->work_type) }}
                </span>
            </div>

            {{-- Status --}}
            <div>
                <p class="mb-1.5 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Status</p>
                @php
                    $statusClass = match ($jobOpening->status) {
                        'open'   => 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-500',
                        'closed' => 'bg-red-50 text-red-700 dark:bg-red-500/15 dark:text-red-500',
                        default  => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400',
                    };
                @endphp
                <span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-medium {{ $statusClass }}">
                    {{ ucfirst($jobOpening->status) }}
                </span>
            </div>

            {{-- Slug --}}
            <div>
                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Slug</p>
                <p class="break-all font-mono text-sm text-gray-600 dark:text-gray-400">{{ $jobOpening->slug }}</p>
            </div>

            {{-- Created At --}}
            <div>
                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Created At</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $jobOpening->created_at->format('d M Y, H:i') }}</p>
            </div>

        </x-common.component-card>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.job-openings.index') }}"
                class="rounded-lg border border-gray-200 px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                Back
            </a>
            <a href="{{ route('admin.job-openings.edit', $jobOpening) }}"
                class="bg-brand-500 hover:bg-brand-600 rounded-lg px-4 py-2.5 text-sm font-medium text-white transition">
                Edit
            </a>
        </div>
    </div>

</div>
