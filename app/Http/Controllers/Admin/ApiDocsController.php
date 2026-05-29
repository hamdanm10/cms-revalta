<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ApiDocsController extends Controller
{
    public function show(): View
    {
        return view('pages.admin.api-docs.show', [
            'title'    => 'API Documentation',
            'apiToken' => config('app.api_token'),
        ]);
    }
}
