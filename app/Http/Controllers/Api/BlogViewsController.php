<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\BlogRepository;
use Illuminate\Http\JsonResponse;

class BlogViewsController extends Controller
{
    public function __construct(
        private BlogRepository $repository,
    ) {}

    public function store(string $slug): JsonResponse
    {
        $incremented = $this->repository->incrementViewsBySlug($slug);

        if (! $incremented) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Blog not found.',
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'View recorded.',
        ]);
    }
}
