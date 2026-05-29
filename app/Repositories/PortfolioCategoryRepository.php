<?php

namespace App\Repositories;

use App\Models\PortfolioCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PortfolioCategoryRepository
{
    public function all(): Collection
    {
        return PortfolioCategory::query()
            ->select(['id', 'name'])
            ->orderBy('name')
            ->get();
    }

    public function totalCount(): int
    {
        return PortfolioCategory::count();
    }

    public function paginate(?string $search, int $perPage = 10): LengthAwarePaginator
    {
        return PortfolioCategory::query()
            ->select(['id', 'name', 'slug', 'created_at'])
            ->when($search, fn($q, $s) => $q->where('name', 'like', '%' . $s . '%'))
            ->latest()
            ->paginate($perPage);
    }
}
