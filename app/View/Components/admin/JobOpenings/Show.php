<?php

namespace App\View\Components\admin\JobOpenings;

use App\Models\JobOpening;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Show extends Component
{
    public function __construct(
        public readonly JobOpening $jobOpening,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.job-openings.show');
    }
}
