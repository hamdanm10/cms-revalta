<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobOpeningsController;
use App\Http\Controllers\Admin\BlogCategoriesController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\PortfolioCategoriesController;
use App\Http\Controllers\Admin\PortfoliosController;
use App\Http\Controllers\Api\JobOpeningsController as ApiJobOpeningsController;
use App\Http\Controllers\Api\BlogsController as ApiBlogsController;
use App\Http\Controllers\Api\PortfoliosController as ApiPortfoliosController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('throttle:60,1')->prefix('api')->name('api.')->group(function () {
    Route::apiResource('job-openings', ApiJobOpeningsController::class)->only(['index']);
    Route::apiResource('portfolios', ApiPortfoliosController::class)->only(['index']);
    Route::apiResource('blogs', ApiBlogsController::class)->only(['index']);
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::singleton('session', SessionController::class)->creatable()->only(['create', 'store']);
    Route::resource('registrations', RegistrationController::class)->only(['create', 'store']);
});

Route::delete('/session', [SessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('session.destroy');

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::singleton('dashboard', DashboardController::class)->only(['show']);

    // Blogs
    Route::post('blogs/upload-image', [BlogsController::class, 'uploadImage'])->name('blogs.upload-image');
    Route::get('blogs/search', [BlogsController::class, 'search'])->name('blogs.search');
    Route::resource('blogs', BlogsController::class);

    // Portfolios
    Route::get('portfolios/search', [PortfoliosController::class, 'search'])->name('portfolios.search');
    Route::resource('portfolios', PortfoliosController::class);

    // JOB OPENINGS
    Route::get('job-openings/search', [JobOpeningsController::class, 'search'])->name('job-openings.search');
    Route::resource('job-openings', JobOpeningsController::class);

    // Blog Categories
    Route::get('blog-categories/search', [BlogCategoriesController::class, 'search'])->name('blog-categories.search');
    Route::resource('blog-categories', BlogCategoriesController::class);

    // Portfolio Categories
    Route::get('portfolio-categories/search', [PortfolioCategoriesController::class, 'search'])->name('portfolio-categories.search');
    Route::resource('portfolio-categories', PortfolioCategoriesController::class);
});

/*
|--------------------------------------------------------------------------
| Root Redirect
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('admin.dashboard.show'));
