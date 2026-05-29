<?php

namespace App\View\Components\admin\Portfolios;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Table extends Component
{
    public function __construct(
        public readonly LengthAwarePaginator $portfolios,
        public readonly Collection $categories,
        public readonly ?string $search = null,
        public readonly ?string $status = null,
        public readonly ?int $categoryId = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.portfolios.table');
    }
}
