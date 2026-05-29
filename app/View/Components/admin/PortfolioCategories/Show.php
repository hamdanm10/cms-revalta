<?php

namespace App\View\Components\admin\PortfolioCategories;

use App\Models\PortfolioCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Show extends Component
{
    public function __construct(
        public readonly PortfolioCategory $portfolioCategory,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.portfolio-categories.show');
    }
}
