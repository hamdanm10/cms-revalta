<?php

namespace App\View\Components\admin\BlogCategories;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateForm extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.admin.blog-categories.create-form');
    }
}
