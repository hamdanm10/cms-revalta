<?php

namespace App\Repositories;

use App\Models\BlogCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository
{
    public function paginate(?string $search, int $perPage = 10): LengthAwarePaginator
    {
        return BlogCategory::query()
            ->select(['id', 'name', 'slug', 'created_at'])
            ->when($search, fn($q, $s) => $q->where('name', 'like', '%' . $s . '%'))
            ->latest()
            ->paginate($perPage);
    }

    public function all(): Collection
    {
        return BlogCategory::query()
            ->select(['id', 'name'])
            ->orderBy('name')
            ->get();
    }
}
