<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogRepository;
use App\Repositories\JobOpeningRepository;
use App\Repositories\PortfolioCategoryRepository;
use App\Repositories\PortfolioRepository;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private readonly BlogRepository $blogRepo,
        private readonly BlogCategoryRepository $blogCategoryRepo,
        private readonly PortfolioRepository $portfolioRepo,
        private readonly PortfolioCategoryRepository $portfolioCategoryRepo,
        private readonly JobOpeningRepository $jobOpeningRepo,
    ) {}

    public function show(): View
    {
        return view('pages.admin.dashboard.show', [
            'title' => 'Dashboard',
            'stats' => [
                'blogs'       => $this->blogRepo->stats(),
                'portfolios'  => $this->portfolioRepo->stats(),
                'jobOpenings' => $this->jobOpeningRepo->stats(),
                'categories'  => [
                    'blog'      => $this->blogCategoryRepo->totalCount(),
                    'portfolio' => $this->portfolioCategoryRepo->totalCount(),
                ],
            ],
            'recentBlogs'       => $this->blogRepo->recentList(5),
            'recentJobOpenings' => $this->jobOpeningRepo->recentList(5),
        ]);
    }
}
