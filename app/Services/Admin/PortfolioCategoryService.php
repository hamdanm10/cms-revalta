<?php

namespace App\Services\Admin;

use App\Models\PortfolioCategory;

class PortfolioCategoryService
{
    public function store(array $data): PortfolioCategory
    {
        return PortfolioCategory::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
        ]);
    }

    public function update(PortfolioCategory $portfolioCategory, array $data): PortfolioCategory
    {
        $portfolioCategory->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
        ]);

        return $portfolioCategory;
    }

    public function destroy(PortfolioCategory $portfolioCategory): void
    {
        $portfolioCategory->delete();
    }
}
