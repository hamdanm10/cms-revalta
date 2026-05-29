<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BlogIndexRequest;
use App\Repositories\BlogRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class BlogsController extends Controller
{
    public function __construct(
        private BlogRepository $repository,
    ) {}

    public function index(BlogIndexRequest $request): JsonResponse
    {
        $paginator = $this->repository->paginateApi(
            search: $request->validated('search'),
            categoryId: $request->validated('category_id'),
            perPage: $request->validated('per_page', 10),
        );

        return response()->json([
            'status' => 'success',
            'data'   => [
                'blogs'      => $paginator->items(),
                'pagination' => $this->paginationMeta($paginator),
            ],
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $blog = $this->repository->findBySlugApi($slug);

        if (! $blog) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Blog not found.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => [
                'blog' => $blog,
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
