<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePortfolioRequest;
use App\Http\Requests\Admin\UpdatePortfolioRequest;
use App\Models\Portfolio;
use App\Repositories\PortfolioCategoryRepository;
use App\Repositories\PortfolioRepository;
use App\Services\Admin\PortfolioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PortfoliosController extends Controller
{
    public function __construct(
        private PortfolioRepository $repository,
        private PortfolioCategoryRepository $categoryRepository,
        private PortfolioService $service,
    ) {}

    public function index(Request $request): View
    {
        ['search' => $search, 'status' => $status, 'category_id' => $categoryId] = $this->filters($request);

        return view('pages.admin.portfolios.index', [
            'title'      => 'Portfolios',
            'portfolios' => $this->repository->paginate($search, $status, $categoryId),
            'categories' => $this->categoryRepository->all(),
            'search'     => $search,
            'status'     => $status,
            'categoryId' => $categoryId,
        ]);
    }

    public function search(Request $request): Response
    {
        ['search' => $search, 'status' => $status, 'category_id' => $categoryId] = $this->filters($request);

        return response()->view('components.admin.portfolios.partials.results', [
            'portfolios' => $this->repository->paginate($search, $status, $categoryId),
        ]);
    }

    public function show(Portfolio $portfolio): View
    {
        return view('pages.admin.portfolios.show', [
            'title'     => $portfolio->title,
            'portfolio' => $portfolio->load('category'),
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.portfolios.create', [
            'title'      => 'Create Portfolio',
            'categories' => $this->categoryRepository->all(),
        ]);
    }

    public function store(StorePortfolioRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());

        return redirect()->route('admin.portfolios.index')
            ->with('toast', ['type' => 'success', 'message' => 'Portfolio created successfully.']);
    }

    public function edit(Portfolio $portfolio): View
    {
        return view('pages.admin.portfolios.edit', [
            'title'      => 'Edit Portfolio',
            'portfolio'  => $portfolio,
            'categories' => $this->categoryRepository->all(),
        ]);
    }

    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio): RedirectResponse
    {
        $this->service->update($portfolio, $request->validated());

        return redirect()->route('admin.portfolios.index')
            ->with('toast', ['type' => 'success', 'message' => 'Portfolio updated successfully.']);
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $this->service->destroy($portfolio);

        return redirect()->route('admin.portfolios.index')
            ->with('toast', ['type' => 'success', 'message' => 'Portfolio deleted successfully.']);
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
