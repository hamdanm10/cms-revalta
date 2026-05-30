<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PortfolioCategoryRepository;
use Illuminate\Http\JsonResponse;

class PortfolioCategoriesController extends Controller
{
    public function __construct(
        private PortfolioCategoryRepository $repository,
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
