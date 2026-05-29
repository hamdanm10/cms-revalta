@props(['stats', 'recentBlogs', 'recentJobOpenings'])

{{-- Stat Cards --}}
<div class="mb-6 grid grid-cols-2 gap-4 sm:gap-6">

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Blog Views</p>
                <h4 class="mt-2 text-2xl font-bold text-gray-800 dark:text-white/90">{{ number_format($stats['blogs']['views']) }}</h4>
                <p class="mt-4 text-xs text-gray-400 dark:text-gray-500">Across {{ $stats['blogs']['total'] }} {{ Str::plural('blog', $stats['blogs']['total']) }}</p>
            </div>
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 dark:bg-brand-500/10">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" class="text-brand-500" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Blogs</p>
                <h4 class="mt-2 text-2xl font-bold text-gray-800 dark:text-white/90">{{ number_format($stats['blogs']['total']) }}</h4>
                <div class="mt-4 flex items-center gap-3">
                    <span class="inline-flex items-center gap-1 text-xs font-medium text-green-600 dark:text-green-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>{{ $stats['blogs']['published'] }} Published
                    </span>
                    <span class="inline-flex items-center gap-1 text-xs font-medium text-yellow-600 dark:text-yellow-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-yellow-400"></span>{{ $stats['blogs']['draft'] }} Draft
                    </span>
                </div>
            </div>
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-violet-50 dark:bg-violet-500/10">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" class="text-violet-500" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6M7 8h10M7 12h10M7 16h6"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Portfolios</p>
                <h4 class="mt-2 text-2xl font-bold text-gray-800 dark:text-white/90">{{ number_format($stats['portfolios']['total']) }}</h4>
                <div class="mt-4 flex items-center gap-3">
                    <span class="inline-flex items-center gap-1 text-xs font-medium text-green-600 dark:text-green-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>{{ $stats['portfolios']['published'] }} Published
                    </span>
                    <span class="inline-flex items-center gap-1 text-xs font-medium text-yellow-600 dark:text-yellow-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-yellow-400"></span>{{ $stats['portfolios']['draft'] }} Draft
                    </span>
                </div>
            </div>
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 dark:bg-blue-500/10">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" class="text-blue-500" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2M9 12h6M9 16h6"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total Job Openings</p>
                <h4 class="mt-2 text-2xl font-bold text-gray-800 dark:text-white/90">{{ number_format($stats['jobOpenings']['total']) }}</h4>
                <div class="mt-4 flex items-center gap-3">
                    <span class="inline-flex items-center gap-1 text-xs font-medium text-green-600 dark:text-green-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>{{ $stats['jobOpenings']['open'] }} Open
                    </span>
                    <span class="inline-flex items-center gap-1 text-xs font-medium text-red-500 dark:text-red-400">
                        <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>{{ $stats['jobOpenings']['closed'] }} Closed
                    </span>
                </div>
            </div>
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-50 dark:bg-orange-500/10">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" class="text-orange-500" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z"/>
                    <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M12 12v.01M3 13a20 20 0 0 0 18 0"/>
                </svg>
            </div>
        </div>
    </div>

</div>

{{-- Content Cards --}}
<div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

    {{-- Recent Blogs --}}
    <div class="xl:col-span-2 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between px-6 py-5">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Recent Blogs</h3>
            <a href="{{ route('admin.blogs.index') }}"
                class="text-sm font-medium text-brand-500 hover:text-brand-600 dark:text-brand-400">View all</a>
        </div>
        <div class="border-t border-gray-100 dark:border-gray-800">
            <div class="max-w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3 text-left sm:px-6">
                                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Title</p>
                            </th>
                            <th class="px-5 py-3 text-left sm:px-6 text-nowrap">
                                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Status</p>
                            </th>
                            <th class="px-5 py-3 text-left sm:px-6 text-nowrap">
                                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Views</p>
                            </th>
                            <th class="px-5 py-3 text-left sm:px-6 text-nowrap">
                                <p class="text-theme-xs font-medium text-gray-500 dark:text-gray-400">Date</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentBlogs as $blog)
                            <tr class="border-b border-gray-100 last:border-0 dark:border-gray-800">
                                <td class="px-5 py-3 sm:px-6">
                                    <a href="{{ route('admin.blogs.show', $blog) }}"
                                        class="block max-w-[180px] truncate text-theme-sm font-medium text-gray-800 hover:text-brand-500 dark:text-white/90 dark:hover:text-brand-400">
                                        {{ $blog->title }}
                                    </a>
                                    <p class="truncate text-theme-xs text-gray-400 dark:text-gray-500">
                                        {{ $blog->category?->name ?? '—' }}
                                    </p>
                                </td>
                                <td class="px-5 py-3 sm:px-6 text-nowrap">
                                    @php
                                        $cls = $blog->status === 'published'
                                            ? 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-400'
                                            : 'bg-yellow-50 text-yellow-700 dark:bg-yellow-500/15 dark:text-yellow-400';
                                    @endphp
                                    <span class="inline-block rounded-full px-2 py-0.5 text-theme-xs font-medium {{ $cls }}">
                                        {{ ucfirst($blog->status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 sm:px-6 text-nowrap">
                                    <p class="text-theme-sm text-gray-500 dark:text-gray-400">{{ number_format($blog->views) }}</p>
                                </td>
                                <td class="px-5 py-3 sm:px-6 text-nowrap">
                                    <p class="text-theme-sm text-gray-400 dark:text-gray-500">{{ $blog->created_at->format('d M Y') }}</p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-8 text-center text-theme-sm text-gray-400 dark:text-gray-600">
                                    No blogs yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Right column --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-1">

        {{-- Recent Job Openings --}}
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex items-center justify-between px-6 py-5">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Job Openings</h3>
                <a href="{{ route('admin.job-openings.index') }}"
                    class="text-sm font-medium text-brand-500 hover:text-brand-600 dark:text-brand-400">View all</a>
            </div>
            <div class="border-t border-gray-100 dark:border-gray-800">
                <ul class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($recentJobOpenings as $job)
                        <li class="flex items-center justify-between gap-3 px-6 py-3">
                            <div class="min-w-0">
                                <a href="{{ route('admin.job-openings.show', $job) }}"
                                    class="block truncate text-theme-sm font-medium text-gray-800 hover:text-brand-500 dark:text-white/90 dark:hover:text-brand-400">
                                    {{ $job->title }}
                                </a>
                                <p class="text-theme-xs text-gray-400 dark:text-gray-500">{{ strtoupper($job->work_type) }}</p>
                            </div>
                            @php
                                $cls = $job->status === 'open'
                                    ? 'bg-green-50 text-green-700 dark:bg-green-500/15 dark:text-green-400'
                                    : 'bg-red-50 text-red-600 dark:bg-red-500/15 dark:text-red-400';
                            @endphp
                            <span class="shrink-0 inline-block rounded-full px-2 py-0.5 text-theme-xs font-medium {{ $cls }}">
                                {{ ucfirst($job->status) }}
                            </span>
                        </li>
                    @empty
                        <li class="px-6 py-8 text-center text-theme-sm text-gray-400 dark:text-gray-600">No job openings yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- Categories --}}
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="px-6 py-5">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Categories</h3>
            </div>
            <div class="border-t border-gray-100 dark:border-gray-800">
                <ul class="divide-y divide-gray-100 dark:divide-gray-800">
                    <li class="flex items-center justify-between gap-3 px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-50 dark:bg-violet-500/10">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="text-violet-500" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h6v6h-6zm10 0h6v6h-6zm-10 10h6v6h-6zm10 3a3 3 0 1 0 6 0a3 3 0 1 0-6 0"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90">Blog</p>
                                <a href="{{ route('admin.blog-categories.index') }}" class="text-theme-xs text-brand-500 hover:text-brand-600">Manage</a>
                            </div>
                        </div>
                        <span class="text-lg font-bold text-gray-800 dark:text-white/90">{{ $stats['categories']['blog'] }}</span>
                    </li>
                    <li class="flex items-center justify-between gap-3 px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 dark:bg-blue-500/10">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="text-blue-500" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h6v6h-6zm10 0h6v6h-6zm-10 10h6v6h-6zm10 3a3 3 0 1 0 6 0a3 3 0 1 0-6 0"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-theme-sm font-medium text-gray-800 dark:text-white/90">Portfolio</p>
                                <a href="{{ route('admin.portfolio-categories.index') }}" class="text-theme-xs text-brand-500 hover:text-brand-600">Manage</a>
                            </div>
                        </div>
                        <span class="text-lg font-bold text-gray-800 dark:text-white/90">{{ $stats['categories']['portfolio'] }}</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>

</div>
