<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function show(): View
    {
        return view('pages.admin.dashboard.show', ['title' => 'Dashboard']);
    }
}
