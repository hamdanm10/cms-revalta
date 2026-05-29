<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\JobOpeningIndexRequest;
use App\Repositories\JobOpeningRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;

class JobOpeningsController extends Controller
{
    public function __construct(
        private JobOpeningRepository $repository,
    ) {}

    public function index(JobOpeningIndexRequest $request): JsonResponse
    {
        $paginator = $this->repository->paginateApi(
            search: $request->validated('search'),
            workType: $request->validated('work_type'),
            status: $request->validated('status'),
            perPage: $request->validated('per_page', 10),
        );

        return response()->json([
            'status' => 'success',
            'data'   => [
                'job_openings' => $paginator->items(),
                'pagination'   => $this->paginationMeta($paginator),
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
