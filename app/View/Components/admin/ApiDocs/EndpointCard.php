<?php

namespace App\View\Components\admin\ApiDocs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EndpointCard extends Component
{
    public function __construct(
        public readonly string $method,
        public readonly string $endpoint,
        public readonly string $title,
        public readonly string $description,
        public readonly array $params,
        public readonly string $response,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.api-docs.endpoint-card');
    }
}
