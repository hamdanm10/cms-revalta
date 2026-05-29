<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class JobOpeningsTable extends Component
{
    public function __construct(
        public readonly LengthAwarePaginator $jobOpenings,
        public readonly ?string $search,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.job-openings-table');
    }
}
