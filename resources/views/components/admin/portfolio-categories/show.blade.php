<div class="space-y-6">
    <x-common.component-card title="Details">

        {{-- Name --}}
        <div>
            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Name</p>
            <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $portfolioCategory->name }}</p>
        </div>

        {{-- Slug --}}
        <div>
            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Slug</p>
            <p class="break-all font-mono text-sm text-gray-600 dark:text-gray-400">{{ $portfolioCategory->slug }}</p>
        </div>

        {{-- Created At --}}
        <div>
            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Created At</p>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $portfolioCategory->created_at->format('d M Y, H:i') }}</p>
        </div>

        {{-- Updated At --}}
        <div>
            <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Updated At</p>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $portfolioCategory->updated_at->format('d M Y, H:i') }}</p>
        </div>

    </x-common.component-card>

    {{-- Actions --}}
    <div class="flex items-center justify-end gap-3">
        <a href="{{ route('admin.portfolio-categories.index') }}"
            class="rounded-lg border border-gray-200 px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
            Back
        </a>
        <a href="{{ route('admin.portfolio-categories.edit', $portfolioCategory) }}"
            class="bg-brand-500 hover:bg-brand-600 rounded-lg px-4 py-2.5 text-sm font-medium text-white transition">
            Edit
        </a>
    </div>
</div>
