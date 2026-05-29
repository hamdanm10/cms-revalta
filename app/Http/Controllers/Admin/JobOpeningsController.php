<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\JobOpeningRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class JobOpeningsController extends Controller
{
    public function __construct(private JobOpeningRepository $repository) {}

    public function index(Request $request): View
    {
        $search   = $request->string('search')->trim()->toString() ?: null;
        $workType = $request->string('work_type')->trim()->toString() ?: null;
        $status   = $request->string('status')->trim()->toString() ?: null;

        return view('pages.admin.job-openings.index', [
            'title'       => 'Job Openings',
            'jobOpenings' => $this->repository->paginate($search, $workType, $status),
            'search'      => $search,
            'workType'    => $workType,
            'status'      => $status,
        ]);
    }

    public function search(Request $request): Response
    {
        $search   = $request->string('search')->trim()->toString() ?: null;
        $workType = $request->string('work_type')->trim()->toString() ?: null;
        $status   = $request->string('status')->trim()->toString() ?: null;

        return response()->view('components.admin.partials.job-openings-results', [
            'jobOpenings' => $this->repository->paginate($search, $workType, $status),
        ]);
    }
}
