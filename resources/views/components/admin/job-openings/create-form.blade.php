<form action="{{ route('admin.job-openings.store') }}" method="POST"
    x-data="{
        title: '{{ old('title') }}',
        slug: '{{ old('slug') }}',
        slugEdited: {{ old('slug') ? 'true' : 'false' }},
        generateSlug(value) {
            if (this.slugEdited) return;
            this.slug = value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }
    }">
    @csrf

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- Main Content --}}
        <div class="space-y-6 xl:col-span-2">
            <x-common.component-card title="Job Details">

                {{-- Title --}}
                <div>
                    <label for="title" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Title <span class="text-error-500">*</span>
                    </label>
                    <input type="text" id="title" name="title"
                        x-model="title"
                        @input="generateSlug($event.target.value)"
                        value="{{ old('title') }}"
                        placeholder="e.g. Frontend Developer"
                        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('title') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}" />
                    @error('title')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Short Description --}}
                <div>
                    <label for="short_description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Short Description <span class="text-error-500">*</span>
                    </label>
                    <input type="text" id="short_description" name="short_description"
                        value="{{ old('short_description') }}"
                        placeholder="Brief summary shown in listings"
                        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('short_description') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}" />
                    @error('short_description')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Description <span class="text-error-500">*</span>
                    </label>
                    <textarea id="description" name="description" rows="8"
                        placeholder="Full job description, requirements, responsibilities..."
                        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('description') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

            </x-common.component-card>
        </div>

        {{-- Sidebar Settings --}}
        <div class="space-y-6">
            <x-common.component-card title="Settings">

                {{-- Work Type --}}
                <div>
                    <label for="work_type" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Work Type <span class="text-error-500">*</span>
                    </label>
                    <div x-data="{ isOptionSelected: {{ old('work_type') ? 'true' : 'false' }} }" class="relative">
                        <select id="work_type" name="work_type"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border bg-transparent px-4 py-2.5 pr-11 text-sm focus:ring-3 focus:outline-hidden dark:bg-gray-900 {{ $errors->has('work_type') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}"
                            :class="isOptionSelected ? 'text-gray-800 dark:text-white/90' : 'text-gray-400 dark:text-gray-600'"
                            @change="isOptionSelected = true">
                            <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                disabled {{ old('work_type') ? '' : 'selected' }}>
                                Select work type
                            </option>
                            @foreach (['remote' => 'Remote', 'wfa' => 'WFA', 'wfo' => 'WFO', 'hybrid' => 'Hybrid'] as $value => $label)
                                <option value="{{ $value }}" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                    {{ old('work_type') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    @error('work_type')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status <span class="text-error-500">*</span>
                    </label>
                    <div class="relative">
                        <select id="status" name="status"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 {{ $errors->has('status') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}">
                            <option value="open" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                {{ old('status', 'open') === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="closed" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                {{ old('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    @error('status')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Slug --}}
                <div>
                    <label for="slug" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Slug <span class="text-error-500">*</span>
                    </label>
                    <input type="text" id="slug" name="slug"
                        x-model="slug"
                        @input="slugEdited = true"
                        placeholder="auto-generated-from-title"
                        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('slug') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}" />
                    <p class="mt-1.5 text-xs text-gray-400 dark:text-gray-600">Auto-generated from title. Edit to override.</p>
                    @error('slug')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

            </x-common.component-card>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.job-openings.index') }}"
                    class="rounded-lg border border-gray-200 px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-brand-500 hover:bg-brand-600 rounded-lg px-4 py-2.5 text-sm font-medium text-white transition">
                    Save Job Opening
                </button>
            </div>
        </div>

    </div>
</form>
