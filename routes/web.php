<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobOpeningsController;
use App\Http\Controllers\Admin\PortfolioCategoriesController;
use App\Http\Controllers\Admin\PortfoliosController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use Illuminate\Support\Facades\Route;

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

    // Portfolios
    Route::get('portfolios/search', [PortfoliosController::class, 'search'])->name('portfolios.search');
    Route::resource('portfolios', PortfoliosController::class);

    // JOB OPENINGS
    Route::get('job-openings/search', [JobOpeningsController::class, 'search'])->name('job-openings.search');
    Route::resource('job-openings', JobOpeningsController::class);

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

/*
|--------------------------------------------------------------------------
| Other Routes
|--------------------------------------------------------------------------
*/

Route::get('/calendar', fn() => view('pages.calender', ['title' => 'Calendar']))->name('calendar');
Route::get('/profile', fn() => view('pages.profile', ['title' => 'Profile']))->name('profile');
Route::get('/form-elements', fn() => view('pages.form.form-elements', ['title' => 'Form Elements']))->name('form-elements');
Route::get('/basic-tables', fn() => view('pages.tables.basic-tables', ['title' => 'Basic Tables']))->name('basic-tables');
Route::get('/blank', fn() => view('pages.blank', ['title' => 'Blank']))->name('blank');
Route::get('/error-404', fn() => abort(404))->name('error-404');
Route::get('/line-chart', fn() => view('pages.chart.line-chart', ['title' => 'Line Chart']))->name('line-chart');
Route::get('/bar-chart', fn() => view('pages.chart.bar-chart', ['title' => 'Bar Chart']))->name('bar-chart');
Route::get('/alerts', fn() => view('pages.ui-elements.alerts', ['title' => 'Alerts']))->name('alerts');
Route::get('/avatars', fn() => view('pages.ui-elements.avatars', ['title' => 'Avatars']))->name('avatars');
Route::get('/badge', fn() => view('pages.ui-elements.badges', ['title' => 'Badges']))->name('badges');
Route::get('/buttons', fn() => view('pages.ui-elements.buttons', ['title' => 'Buttons']))->name('buttons');
Route::get('/image', fn() => view('pages.ui-elements.images', ['title' => 'Images']))->name('images');
Route::get('/videos', fn() => view('pages.ui-elements.videos', ['title' => 'Videos']))->name('videos');
