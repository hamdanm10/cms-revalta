<?php

namespace App\View\Components\admin\BlogCategories;

use App\Models\BlogCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditForm extends Component
{
    public function __construct(
        public readonly BlogCategory $blogCategory,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.blog-categories.edit-form');
    }
}
