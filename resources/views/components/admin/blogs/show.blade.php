<div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

    {{-- Content Preview --}}
    <div class="xl:col-span-2 space-y-6">
        <x-common.component-card title="Thumbnail">
            <img src="{{ $blog->thumbnail }}" alt="{{ $blog->title }}"
                class="w-full rounded-lg object-cover" />
        </x-common.component-card>

        <x-common.component-card title="Content">
            <div class="quill-content">
                {!! $blog->content !!}
            </div>
        </x-common.component-card>
    </div>

    {{-- Detail Info --}}
    <div class="space-y-6">
        <x-common.component-card title="Blog Details">

            {{-- Title --}}
            <div>
                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Title</p>
                <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ $blog->title }}</p>
            </div>

            {{-- Short Description --}}
            <div>
                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Short Description</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $blog->short_description }}</p>
            </div>

            {{-- Keywords --}}
            <div>
                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Keywords</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $blog->keywords ?? '-' }}</p>
            </div>

            {{-- Category --}}
            <div>
                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Category</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $blog->category?->name ?? '-' }}</p>
            </div>

            {{-- Status --}}
            <div>
                <p class="mb-1.5 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Status</p>
                @php
                    $statusClass = match ($blog->status) {
                        'published' => 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-500',
                        'draft'     => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400',
                        default     => 'bg-gray-50 text-gray-700 dark:bg-gray-500/15 dark:text-gray-400',
                    };
                @endphp
                <span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-medium {{ $statusClass }}">
                    {{ ucfirst($blog->status) }}
                </span>
            </div>

            {{-- Slug --}}
            <div>
                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Slug</p>
                <p class="break-all font-mono text-sm text-gray-600 dark:text-gray-400">{{ $blog->slug }}</p>
            </div>

            {{-- Views --}}
            <div>
                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Views</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ number_format($blog->views) }}</p>
            </div>

            {{-- Published At --}}
            @if ($blog->published_at)
                <div>
                    <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Published At</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $blog->published_at->format('d M Y, H:i') }}</p>
                </div>
            @endif

            {{-- Created At --}}
            <div>
                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">Created At</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $blog->created_at->format('d M Y, H:i') }}</p>
            </div>

        </x-common.component-card>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.blogs.index') }}"
                class="rounded-lg border border-gray-200 px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                Back
            </a>
            <a href="{{ route('admin.blogs.edit', $blog) }}"
                class="bg-brand-500 hover:bg-brand-600 rounded-lg px-4 py-2.5 text-sm font-medium text-white transition">
                Edit
            </a>
        </div>
    </div>

</div>
