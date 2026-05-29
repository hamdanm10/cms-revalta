<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PortfolioIndexRequest;
use App\Repositories\PortfolioRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class PortfoliosController extends Controller
{
    public function __construct(
        private PortfolioRepository $repository,
    ) {}

    public function index(PortfolioIndexRequest $request): JsonResponse
    {
        $paginator = $this->repository->paginateApi(
            search: $request->validated('search'),
            categoryId: $request->validated('category_id'),
            perPage: $request->validated('per_page', 10),
        );

        return response()->json([
            'status' => 'success',
            'data'   => [
                'portfolios' => $paginator->items(),
                'pagination' => $this->paginationMeta($paginator),
            ],
        ]);
    }

    private function paginationMeta(LengthAwarePaginator $paginator): array
    {
        return [
            'total'         => $paginator->total(),
            'per_page'      => $paginator->perPage(),
            'current_page'  => $paginator->currentPage(),
            'last_page'     => $paginator->lastPage(),
            'from'          => $paginator->firstItem(),
            'to'            => $paginator->lastItem(),
            'next_page_url' => $paginator->nextPageUrl(),
            'prev_page_url' => $paginator->previousPageUrl(),
        ];
    }
}
