<?php

namespace App\View\Components\admin\PortfolioCategories;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public function __construct(
        public readonly LengthAwarePaginator $portfolioCategories,
        public readonly ?string $search = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.portfolio-categories.table');
    }
}
