<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class JobOpeningsController extends Controller
{
  public function index(): View
  {
    return view('pages.admin.job-openings.index', ['title' => 'Job Openings']);
  }
}
