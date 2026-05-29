<?php

namespace App\View\Components\admin\Portfolios;

use App\Models\Portfolio;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Show extends Component
{
    public function __construct(
        public readonly Portfolio $portfolio,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.portfolios.show');
    }
}
