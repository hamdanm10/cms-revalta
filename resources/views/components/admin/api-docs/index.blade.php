<div class="space-y-6">

    {{-- Info --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
            <h2 class="text-base font-semibold text-gray-800 dark:text-white">General Information</h2>
        </div>
        <div class="space-y-4 p-5">
            <div>
                <p class="mb-1 text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Base URL</p>
                <code class="rounded-lg bg-gray-100 px-3 py-2 text-sm text-gray-800 dark:bg-gray-800 dark:text-gray-200">
                    {{ url('/api') }}
                </code>
            </div>
            <div>
                <p class="mb-2 text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Required Headers</p>
                <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-4 py-2.5 text-left font-medium text-gray-600 dark:text-gray-400">Header</th>
                                <th class="px-4 py-2.5 text-left font-medium text-gray-600 dark:text-gray-400">Value</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            <tr>
                                <td class="px-4 py-2.5 font-mono text-gray-700 dark:text-gray-300">Accept</td>
                                <td class="px-4 py-2.5 font-mono text-gray-700 dark:text-gray-300">application/json</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2.5 font-mono text-gray-700 dark:text-gray-300">X-API-Token</td>
                                <td class="px-4 py-2.5 font-mono text-gray-700 dark:text-gray-300">{{ $apiToken }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Registrations --}}
    <x-admin.api-docs.endpoint-card
        method="POST"
        endpoint="/api/registrations"
        title="Register User"
        description="Register a new user account."
        :params="[
            ['name' => 'name', 'type' => 'string', 'required' => true, 'description' => 'Full name of the user'],
            ['name' => 'email', 'type' => 'string', 'required' => true, 'description' => 'Valid and unique email address'],
            ['name' => 'password', 'type' => 'string', 'required' => true, 'description' => 'Minimum 8 characters, must contain letters and numbers'],
            ['name' => 'password_confirmation', 'type' => 'string', 'required' => true, 'description' => 'Must match password'],
        ]"
        response='{
    "status": "success",
    "message": "Registration successful.",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com"
        }
    }
}' />

    {{-- Job Openings --}}
    <x-admin.api-docs.endpoint-card
        method="GET"
        endpoint="/api/job-openings"
        title="List Job Openings"
        description="Retrieve a paginated list of published job openings."
        :params="[
            ['name' => 'search', 'type' => 'string', 'required' => false, 'description' => 'Filter by title'],
            ['name' => 'work_type', 'type' => 'string', 'required' => false, 'description' => 'Filter by work type: remote, wfa, wfo, hybrid'],
            ['name' => 'status', 'type' => 'string', 'required' => false, 'description' => 'Filter by status: open, closed'],
            ['name' => 'per_page', 'type' => 'integer', 'required' => false, 'description' => 'Items per page (default: 10, max: 100)'],
        ]"
        response='{
    "status": "success",
    "data": {
        "job_openings": [...],
        "pagination": {
            "total": 20,
            "per_page": 10,
            "current_page": 1,
            "last_page": 2
        }
    }
}' />

    {{-- Portfolios --}}
    <x-admin.api-docs.endpoint-card
        method="GET"
        endpoint="/api/portfolios"
        title="List Portfolios"
        description="Retrieve a paginated list of published portfolios."
        :params="[
            ['name' => 'search', 'type' => 'string', 'required' => false, 'description' => 'Filter by title'],
            ['name' => 'category_id', 'type' => 'integer', 'required' => false, 'description' => 'Filter by category ID'],
            ['name' => 'per_page', 'type' => 'integer', 'required' => false, 'description' => 'Items per page (default: 10, max: 100)'],
        ]"
        response='{
    "status": "success",
    "data": {
        "portfolios": [...],
        "pagination": {
            "total": 15,
            "per_page": 10,
            "current_page": 1,
            "last_page": 2
        }
    }
}' />

    {{-- Blogs --}}
    <x-admin.api-docs.endpoint-card
        method="GET"
        endpoint="/api/blogs"
        title="List Blogs"
        description="Retrieve a paginated list of published blogs. Content field is excluded."
        :params="[
            ['name' => 'search', 'type' => 'string', 'required' => false, 'description' => 'Filter by title'],
            ['name' => 'category_id', 'type' => 'integer', 'required' => false, 'description' => 'Filter by category ID'],
            ['name' => 'per_page', 'type' => 'integer', 'required' => false, 'description' => 'Items per page (default: 10, max: 100)'],
        ]"
        response='{
    "status": "success",
    "data": {
        "blogs": [...],
        "pagination": {
            "total": 30,
            "per_page": 10,
            "current_page": 1,
            "last_page": 3
        }
    }
}' />

    {{-- Blog Show --}}
    <x-admin.api-docs.endpoint-card
        method="GET"
        endpoint="/api/blogs/{slug}"
        title="Show Blog"
        description="Retrieve a single published blog by its slug including content."
        :params="[
            ['name' => 'slug', 'type' => 'string', 'required' => true, 'description' => 'The blog slug (URL parameter)'],
        ]"
        response='{
    "status": "success",
    "data": {
        "blog": {
            "id": 1,
            "title": "Blog Title",
            "slug": "blog-title",
            "thumbnail": "portfolios/image.png",
            "short_description": "...",
            "content": "...",
            "status": "published",
            "published_at": "2026-01-01T00:00:00.000000Z",
            "views": 100,
            "category": { "id": 1, "name": "Technology" }
        }
    }
}' />

    {{-- Blog Record View --}}
    <x-admin.api-docs.endpoint-card
        method="POST"
        endpoint="/api/blogs/{slug}/views"
        title="Record Blog View"
        description="Increment the view counter for a published blog."
        :params="[
            ['name' => 'slug', 'type' => 'string', 'required' => true, 'description' => 'The blog slug (URL parameter)'],
        ]"
        response='{
    "status": "success",
    "message": "View recorded."
}' />

</div>
