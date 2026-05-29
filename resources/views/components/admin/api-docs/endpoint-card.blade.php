@php
    $methodColors = [
        'GET'  => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400',
        'POST' => 'bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400',
    ];
    $badgeClass = $methodColors[$method] ?? 'bg-gray-100 text-gray-700';
@endphp

<div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

    <div class="flex items-center gap-3 border-b border-gray-100 px-5 py-4 dark:border-gray-800">
        <span class="rounded-md px-2.5 py-1 text-xs font-bold tracking-wide {{ $badgeClass }}">
            {{ $method }}
        </span>
        <code class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $endpoint }}</code>
        <span class="ml-auto text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $title }}</span>
    </div>

    <div class="p-5 space-y-5">

        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $description }}</p>

        @if (count($params))
            <div>
                <p class="mb-2 text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                    Parameters
                </p>
                <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-4 py-2.5 text-left font-medium text-gray-600 dark:text-gray-400">Name</th>
                                <th class="px-4 py-2.5 text-left font-medium text-gray-600 dark:text-gray-400">Type</th>
                                <th class="px-4 py-2.5 text-left font-medium text-gray-600 dark:text-gray-400">Required</th>
                                <th class="px-4 py-2.5 text-left font-medium text-gray-600 dark:text-gray-400">Description</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach ($params as $param)
                                <tr>
                                    <td class="px-4 py-2.5 font-mono text-gray-700 dark:text-gray-300">{{ $param['name'] }}</td>
                                    <td class="px-4 py-2.5 text-gray-600 dark:text-gray-400">{{ $param['type'] }}</td>
                                    <td class="px-4 py-2.5">
                                        @if ($param['required'])
                                            <span class="rounded-md bg-red-100 px-2 py-0.5 text-xs font-medium text-red-600 dark:bg-red-500/20 dark:text-red-400">required</span>
                                        @else
                                            <span class="rounded-md bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-500 dark:bg-gray-700 dark:text-gray-400">optional</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2.5 text-gray-600 dark:text-gray-400">{{ $param['description'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <div>
            <p class="mb-2 text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                Response Example
            </p>
            <pre class="overflow-x-auto rounded-lg bg-gray-950 p-4 text-xs text-gray-200">{{ $response }}</pre>
        </div>

    </div>
</div>
