<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogRepository
{
    public function paginate(?string $search, ?string $status = null, ?int $categoryId = null, int $perPage = 10): LengthAwarePaginator
    {
        return Blog::query()
            ->select(['id', 'category_id', 'title', 'status', 'created_at'])
            ->with('category:id,name')
            ->when($search, fn($q, $s) => $q->where('title', 'like', '%' . $s . '%'))
            ->when($status, fn($q, $v) => $q->where('status', $v))
            ->when($categoryId, fn($q, $v) => $q->where('category_id', $v))
            ->latest()
            ->paginate($perPage);
    }
}
