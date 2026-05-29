<?php

namespace App\Repositories;

use App\Models\JobOpening;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class JobOpeningRepository
{
    public function paginate(?string $search, int $perPage = 10): LengthAwarePaginator
    {
        return JobOpening::query()
            ->select(['id', 'title', 'work_type', 'status', 'created_at'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                        ->orWhere('work_type', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate($perPage);
    }
}
