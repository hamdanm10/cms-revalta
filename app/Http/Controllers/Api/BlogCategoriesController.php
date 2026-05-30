<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\JsonResponse;

class BlogCategoriesController extends Controller
{
    public function __construct(
        private BlogCategoryRepository $repository,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data'   => [
                'categories' => $this->repository->all(),
            ],
        ]);
    }
}
