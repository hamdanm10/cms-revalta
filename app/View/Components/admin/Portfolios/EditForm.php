<?php

namespace App\View\Components\admin\Portfolios;

use App\Models\Portfolio;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class EditForm extends Component
{
    public function __construct(
        public readonly Portfolio $portfolio,
        public readonly Collection $categories,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.portfolios.edit-form');
    }
}
