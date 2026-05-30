<?php

use App\Http\Controllers\Api\BlogCategoriesController;
use App\Http\Controllers\Api\BlogsController;
use App\Http\Controllers\Api\BlogViewsController;
use App\Http\Controllers\Api\JobOpeningsController;
use App\Http\Controllers\Api\PortfolioCategoriesController;
use App\Http\Controllers\Api\PortfoliosController;
use App\Http\Controllers\Api\RegistrationsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('registrations', RegistrationsController::class)->only(['store']);
Route::apiResource('job-openings', JobOpeningsController::class)->only(['index']);
Route::apiResource('blog-categories', BlogCategoriesController::class)->only(['index']);
Route::apiResource('portfolio-categories', PortfolioCategoriesController::class)->only(['index']);
Route::apiResource('portfolios', PortfoliosController::class)->only(['index']);
Route::apiResource('blogs', BlogsController::class)->only(['index', 'show'])->parameters(['blogs' => 'slug']);
Route::apiResource('blogs.views', BlogViewsController::class)->only(['store'])->parameters(['blogs' => 'slug']);
