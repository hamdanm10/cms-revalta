<?php

namespace App\Services\Admin;

use App\Models\BlogCategory;

class BlogCategoryService
{
    public function store(array $data): BlogCategory
    {
        return BlogCategory::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
        ]);
    }

    public function update(BlogCategory $blogCategory, array $data): BlogCategory
    {
        $blogCategory->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
        ]);

        return $blogCategory;
    }

    public function destroy(BlogCategory $blogCategory): void
    {
        $blogCategory->delete();
    }
}
