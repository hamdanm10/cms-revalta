<?php

namespace App\View\Components\admin\Portfolios;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CreateForm extends Component
{
    public function __construct(
        public readonly Collection $categories,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.portfolios.create-form');
    }
}
