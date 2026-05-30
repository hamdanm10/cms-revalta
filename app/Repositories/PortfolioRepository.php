<?php

namespace App\Repositories;

use App\Models\Portfolio;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PortfolioRepository
{
    public function paginate(?string $search, ?string $status = null, ?int $categoryId = null, int $perPage = 10): LengthAwarePaginator
    {
        return Portfolio::query()
            ->select(['id', 'category_id', 'title', 'status', 'created_at'])
            ->with('category:id,name')
            ->when($search, fn($q, $s) => $q->where('title', 'like', '%' . $s . '%'))
            ->when($status, fn($q, $v) => $q->where('status', $v))
            ->when($categoryId, fn($q, $v) => $q->where('category_id', $v))
            ->latest()
            ->paginate($perPage);
    }

    public function paginateApi(?string $search, ?int $categoryId = null, int $perPage = 10): LengthAwarePaginator
    {
        return Portfolio::query()
            ->select(['category_id', 'title', 'short_description', 'description', 'thumbnail', 'slug', 'status'])
            ->with('category:id,name')
            ->where('status', 'published')
            ->when($search, fn($q, $s) => $q->where('title', 'like', '%' . $s . '%'))
            ->when($categoryId, fn($q, $v) => $q->where('category_id', $v))
            ->latest()
            ->paginate($perPage)
            ->through(function ($portfolio) {
                $portfolio->category?->makeHidden('id');
                return $portfolio->makeHidden('category_id');
            });
    }

    public function stats(): array
    {
        return [
            'total'     => Portfolio::count(),
            'published' => Portfolio::where('status', 'published')->count(),
            'draft'     => Portfolio::where('status', 'draft')->count(),
        ];
    }
}
