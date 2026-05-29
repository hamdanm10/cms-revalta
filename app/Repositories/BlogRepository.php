<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BlogRepository
{
    public function paginate(?string $search, ?string $status = null, ?int $categoryId = null, int $perPage = 10): LengthAwarePaginator
    {
        return Blog::query()
            ->select(['id', 'category_id', 'title', 'status', 'views', 'created_at'])
            ->with('category:id,name')
            ->when($search, fn($q, $s) => $q->where('title', 'like', '%' . $s . '%'))
            ->when($status, fn($q, $v) => $q->where('status', $v))
            ->when($categoryId, fn($q, $v) => $q->where('category_id', $v))
            ->latest()
            ->paginate($perPage);
    }

    public function stats(): array
    {
        return [
            'total'     => Blog::count(),
            'published' => Blog::where('status', 'published')->count(),
            'draft'     => Blog::where('status', 'draft')->count(),
            'views'     => (int) Blog::sum('views'),
        ];
    }

    public function recentList(int $limit = 5): Collection
    {
        return Blog::query()
            ->with('category:id,name')
            ->latest()
            ->limit($limit)
            ->get(['id', 'category_id', 'title', 'status', 'views', 'created_at']);
    }
}
