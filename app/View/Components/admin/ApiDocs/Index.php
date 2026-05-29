<?php

namespace App\View\Components\admin\ApiDocs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Index extends Component
{
    public function __construct(
        public readonly string $apiToken,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.api-docs.index');
    }
}
