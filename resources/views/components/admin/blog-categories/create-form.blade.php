<form action="{{ route('admin.blog-categories.store') }}" method="POST"
    x-data="{
        name: '{{ old('name') }}',
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
            <x-common.component-card title="Category Details">

                {{-- Name --}}
                <div>
                    <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Name <span class="text-error-500">*</span>
                    </label>
                    <input type="text" id="name" name="name"
                        x-model="name"
                        @input="generateSlug($event.target.value)"
                        value="{{ old('name') }}"
                        placeholder="e.g. Technology"
                        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('name') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}" />
                    @error('name')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

            </x-common.component-card>
        </div>

        {{-- Sidebar Settings --}}
        <div class="space-y-6">
            <x-common.component-card title="Settings">

                {{-- Slug --}}
                <div>
                    <label for="slug" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Slug <span class="text-error-500">*</span>
                    </label>
                    <input type="text" id="slug" name="slug"
                        x-model="slug"
                        @input="slugEdited = true"
                        placeholder="auto-generated-from-name"
                        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('slug') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}" />
                    <p class="mt-1.5 text-xs text-gray-400 dark:text-gray-600">Auto-generated from name. Edit to override.</p>
                    @error('slug')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

            </x-common.component-card>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.blog-categories.index') }}"
                    class="rounded-lg border border-gray-200 px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-brand-500 hover:bg-brand-600 rounded-lg px-4 py-2.5 text-sm font-medium text-white transition">
                    Save Category
                </button>
            </div>
        </div>

    </div>
</form>
