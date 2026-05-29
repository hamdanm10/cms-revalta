<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePortfolioCategoryRequest;
use App\Http\Requests\Admin\UpdatePortfolioCategoryRequest;
use App\Models\PortfolioCategory;
use App\Repositories\PortfolioCategoryRepository;
use App\Services\Admin\PortfolioCategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PortfolioCategoriesController extends Controller
{
    public function __construct(
        private PortfolioCategoryRepository $repository,
        private PortfolioCategoryService $service,
    ) {}

    public function index(Request $request): View
    {
        $search = $this->extractSearch($request);

        return view('pages.admin.portfolio-categories.index', [
            'title'               => 'Portfolio Categories',
            'portfolioCategories' => $this->repository->paginate($search),
            'search'              => $search,
        ]);
    }

    public function search(Request $request): Response
    {
        $search = $this->extractSearch($request);

        return response()->view('components.admin.portfolio-categories.partials.results', [
            'portfolioCategories' => $this->repository->paginate($search),
        ]);
    }

    public function show(PortfolioCategory $portfolioCategory): View
    {
        return view('pages.admin.portfolio-categories.show', [
            'title'             => $portfolioCategory->name,
            'portfolioCategory' => $portfolioCategory,
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.portfolio-categories.create', [
            'title' => 'Create Portfolio Category',
        ]);
    }

    public function store(StorePortfolioCategoryRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());

        return redirect()->route('admin.portfolio-categories.index')
            ->with('toast', ['type' => 'success', 'message' => 'Portfolio category created successfully.']);
    }

    public function edit(PortfolioCategory $portfolioCategory): View
    {
        return view('pages.admin.portfolio-categories.edit', [
            'title'             => 'Edit Portfolio Category',
            'portfolioCategory' => $portfolioCategory,
        ]);
    }

    public function update(UpdatePortfolioCategoryRequest $request, PortfolioCategory $portfolioCategory): RedirectResponse
    {
        $this->service->update($portfolioCategory, $request->validated());

        return redirect()->route('admin.portfolio-categories.index')
            ->with('toast', ['type' => 'success', 'message' => 'Portfolio category updated successfully.']);
    }

    public function destroy(PortfolioCategory $portfolioCategory): RedirectResponse
    {
        $this->service->destroy($portfolioCategory);

        return redirect()->route('admin.portfolio-categories.index')
            ->with('toast', ['type' => 'success', 'message' => 'Portfolio category deleted successfully.']);
    }

    private function extractSearch(Request $request): ?string
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        return filled($validated['search'] ?? null) ? trim($validated['search']) : null;
    }
}
