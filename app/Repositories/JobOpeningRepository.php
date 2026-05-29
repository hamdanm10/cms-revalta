<?php

namespace App\Repositories;

use App\Models\JobOpening;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class JobOpeningRepository
{
    public function paginate(?string $search, ?string $workType = null, ?string $status = null, int $perPage = 10): LengthAwarePaginator
    {
        return JobOpening::query()
            ->select(['id', 'title', 'work_type', 'status', 'created_at'])
            ->when($search, fn($q, $s) => $q->where('title', 'like', '%' . $s . '%'))
            ->when($workType, fn($q, $v) => $q->where('work_type', $v))
            ->when($status, fn($q, $v) => $q->where('status', $v))
            ->latest()
            ->paginate($perPage);
    }
}
