<?php

namespace App\Repositories;

use App\Models\PortfolioCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PortfolioCategoryRepository
{
    public function paginate(?string $search, int $perPage = 10): LengthAwarePaginator
    {
        return PortfolioCategory::query()
            ->select(['id', 'name', 'slug', 'created_at'])
            ->when($search, fn($q, $s) => $q->where('name', 'like', '%' . $s . '%'))
            ->latest()
            ->paginate($perPage);
    }
}
