<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Models\Blog;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogRepository;
use App\Services\Admin\BlogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BlogsController extends Controller
{
    public function __construct(
        private BlogRepository $repository,
        private BlogCategoryRepository $categoryRepository,
        private BlogService $service,
    ) {}

    public function index(Request $request): View
    {
        ['search' => $search, 'status' => $status, 'category_id' => $categoryId] = $this->filters($request);

        return view('pages.admin.blogs.index', [
            'title'      => 'Blogs',
            'blogs'      => $this->repository->paginate($search, $status, $categoryId),
            'categories' => $this->categoryRepository->all(),
            'search'     => $search,
            'status'     => $status,
            'categoryId' => $categoryId,
        ]);
    }

    public function search(Request $request): Response
    {
        ['search' => $search, 'status' => $status, 'category_id' => $categoryId] = $this->filters($request);

        return response()->view('components.admin.blogs.partials.results', [
            'blogs' => $this->repository->paginate($search, $status, $categoryId),
        ]);
    }

    public function show(Blog $blog): View
    {
        return view('pages.admin.blogs.show', [
            'title' => $blog->title,
            'blog'  => $blog->load('category'),
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.blogs.create', [
            'title'      => 'Create Blog',
            'categories' => $this->categoryRepository->all(),
        ]);
    }

    public function store(StoreBlogRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());

        return redirect()->route('admin.blogs.index')
            ->with('toast', ['type' => 'success', 'message' => 'Blog created successfully.']);
    }

    public function edit(Blog $blog): View
    {
        return view('pages.admin.blogs.edit', [
            'title'      => 'Edit Blog',
            'blog'       => $blog,
            'categories' => $this->categoryRepository->all(),
        ]);
    }

    public function update(UpdateBlogRequest $request, Blog $blog): RedirectResponse
    {
        $this->service->update($blog, $request->validated());

        return redirect()->route('admin.blogs.index')
            ->with('toast', ['type' => 'success', 'message' => 'Blog updated successfully.']);
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $this->service->destroy($blog);

        return redirect()->route('admin.blogs.index')
            ->with('toast', ['type' => 'success', 'message' => 'Blog deleted successfully.']);
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $request->validate(['image' => ['required', 'mimes:jpeg,jpg,png,webp,gif', 'max:5120']]);

        $path = $this->service->storeImage($request->file('image'));

        return response()->json(['url' => asset('storage/' . $path)]);
    }

    private function filters(Request $request): array
    {
        $validated = $request->validate([
            'search'      => ['nullable', 'string', 'max:100'],
            'status'      => ['nullable', Rule::in(['published', 'draft'])],
            'category_id' => ['nullable', 'integer'],
        ]);

        return [
            'search'      => filled($validated['search'] ?? null) ? trim($validated['search']) : null,
            'status'      => $validated['status'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
        ];
    }
}
