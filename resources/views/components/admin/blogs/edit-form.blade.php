<form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data"
    x-data="{
        title: '{{ old('title', $blog->title) }}',
        slug: '{{ old('slug', $blog->slug) }}',
        slugEdited: true,
        thumbnailPreview: null,
        generateSlug(value) {
            if (this.slugEdited) return;
            this.slug = value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        },
        onThumbnailChange(event) {
            const file = event.target.files[0];
            if (!file) return;
            this.thumbnailPreview = URL.createObjectURL(file);
        }
    }">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- Main Content --}}
        <div class="space-y-6 xl:col-span-2">
            <x-common.component-card title="Blog Details">

                {{-- Title --}}
                <div>
                    <label for="title" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Title <span class="text-error-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" x-model="title"
                        @input="generateSlug($event.target.value)" value="{{ old('title', $blog->title) }}"
                        placeholder="e.g. Getting Started with Laravel"
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
                        value="{{ old('short_description', $blog->short_description) }}"
                        placeholder="Brief summary shown in listings"
                        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('short_description') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}" />
                    @error('short_description')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Keywords --}}
                <div>
                    <label for="keywords" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Keywords <span class="text-error-500">*</span> <span class="text-xs font-normal text-gray-400">(SEO)</span>
                    </label>
                    <input type="text" id="keywords" name="keywords"
                        value="{{ old('keywords', $blog->keywords) }}"
                        placeholder="e.g. laravel, php, web development"
                        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('keywords') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}" />
                    <p class="mt-1.5 text-xs text-gray-400 dark:text-gray-600">Separate keywords with commas. Used for meta keywords tag.</p>
                    @error('keywords')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Content --}}
                <div>
                    <label for="content" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Content <span class="text-error-500">*</span>
                    </label>
                    <x-form.quill-editor
                        name="content"
                        :value="old('content', $blog->content)"
                        placeholder="Write your blog content here..." />
                    @error('content')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Thumbnail --}}
                <div>
                    <label for="thumbnail" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Thumbnail
                    </label>
                    <div class="space-y-3">
                        <img :src="thumbnailPreview ?? '{{ Storage::url($blog->thumbnail) }}'"
                            alt="{{ $blog->title }}" class="h-40 w-full rounded-lg object-cover" />
                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                            @change="onThumbnailChange($event)"
                            class="w-full rounded-lg border px-4 py-2.5 text-sm text-gray-700 file:mr-4 file:rounded-lg file:border-0 file:bg-brand-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-brand-600 hover:file:bg-brand-100 dark:text-gray-300 dark:file:bg-brand-500/10 dark:file:text-brand-400 {{ $errors->has('thumbnail') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}" />
                        <p class="text-xs text-gray-400 dark:text-gray-600">Leave empty to keep the current thumbnail. Accepted: JPG, PNG, WebP. Max 2MB.</p>
                    </div>
                    @error('thumbnail')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

            </x-common.component-card>
        </div>

        {{-- Sidebar Settings --}}
        <div class="space-y-6">
            <x-common.component-card title="Settings">

                {{-- Category --}}
                <div>
                    <label for="category_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Category <span class="text-error-500">*</span>
                    </label>
                    <div x-data="{ isOptionSelected: true }" class="relative">
                        <select id="category_id" name="category_id"
                            class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border bg-transparent px-4 py-2.5 pr-11 text-sm focus:ring-3 focus:outline-hidden dark:bg-gray-900 {{ $errors->has('category_id') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}"
                            :class="isOptionSelected ? 'text-gray-800 dark:text-white/90' : 'text-gray-400 dark:text-gray-600'"
                            @change="isOptionSelected = true">
                            <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400" disabled>
                                Select category
                            </option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                    {{ old('category_id', $blog->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="pointer-events-none absolute top-1/2 right-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                    @error('category_id')
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
                            <option value="draft" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                {{ old('status', $blog->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400"
                                {{ old('status', $blog->status) === 'published' ? 'selected' : '' }}>Published</option>
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
                    <input type="text" id="slug" name="slug" x-model="slug" @input="slugEdited = true"
                        placeholder="auto-generated-from-title"
                        class="shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 {{ $errors->has('slug') ? 'border-error-500 dark:border-error-500' : 'border-gray-300 dark:border-gray-700' }}" />
                    <p class="mt-1.5 text-xs text-gray-400 dark:text-gray-600">Edit to override the current slug.</p>
                    @error('slug')
                        <p class="mt-1.5 text-sm text-error-500">{{ $message }}</p>
                    @enderror
                </div>

            </x-common.component-card>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.blogs.index') }}"
                    class="rounded-lg border border-gray-200 px-4 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-50 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-brand-500 hover:bg-brand-600 rounded-lg px-4 py-2.5 text-sm font-medium text-white transition">
                    Update Blog
                </button>
            </div>
        </div>

    </div>
</form>
