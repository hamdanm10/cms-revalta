<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogCategoryRequest;
use App\Http\Requests\Admin\UpdateBlogCategoryRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use App\Services\Admin\BlogCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BlogCategoriesController extends Controller
{
    public function __construct(
        private BlogCategoryRepository $repository,
        private BlogCategoryService $service,
    ) {}

    public function index(Request $request): View
    {
        $search = $this->extractSearch($request);

        return view('pages.admin.blog-categories.index', [
            'title'          => 'Blog Categories',
            'blogCategories' => $this->repository->paginate($search),
            'search'         => $search,
        ]);
    }

    public function search(Request $request): Response
    {
        $search = $this->extractSearch($request);

        return response()->view('components.admin.blog-categories.partials.results', [
            'blogCategories' => $this->repository->paginate($search),
        ]);
    }

    public function show(BlogCategory $blogCategory): View
    {
        return view('pages.admin.blog-categories.show', [
            'title'        => $blogCategory->name,
            'blogCategory' => $blogCategory,
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.blog-categories.create', [
            'title' => 'Create Blog Category',
        ]);
    }

    public function store(StoreBlogCategoryRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());

        return redirect()->route('admin.blog-categories.index')
            ->with('toast', ['type' => 'success', 'message' => 'Blog category created successfully.']);
    }

    public function edit(BlogCategory $blogCategory): View
    {
        return view('pages.admin.blog-categories.edit', [
            'title'        => 'Edit Blog Category',
            'blogCategory' => $blogCategory,
        ]);
    }

    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory): RedirectResponse
    {
        $this->service->update($blogCategory, $request->validated());

        return redirect()->route('admin.blog-categories.index')
            ->with('toast', ['type' => 'success', 'message' => 'Blog category updated successfully.']);
    }

    public function destroy(BlogCategory $blogCategory): RedirectResponse
    {
        $this->service->destroy($blogCategory);

        return redirect()->route('admin.blog-categories.index')
            ->with('toast', ['type' => 'success', 'message' => 'Blog category deleted successfully.']);
    }

    private function extractSearch(Request $request): ?string
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        return filled($validated['search'] ?? null) ? trim($validated['search']) : null;
    }
}
