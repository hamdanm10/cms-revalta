<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\JobOpeningRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobOpeningsController extends Controller
{
    public function __construct(private JobOpeningRepository $repository) {}

    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString() ?: null;

        $jobOpenings = $this->repository->paginate($search);

        return view('pages.admin.job-openings.index', [
            'title'       => 'Job Openings',
            'jobOpenings' => $jobOpenings,
            'search'      => $search,
        ]);
    }
}
