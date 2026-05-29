<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\JobOpeningRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class JobOpeningsController extends Controller
{
    public function __construct(private JobOpeningRepository $repository) {}

    public function index(Request $request): View
    {
        ['search' => $search, 'work_type' => $workType, 'status' => $status] = $this->filters($request);

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
        ['search' => $search, 'work_type' => $workType, 'status' => $status] = $this->filters($request);

        return response()->view('components.admin.partials.job-openings-results', [
            'jobOpenings' => $this->repository->paginate($search, $workType, $status),
        ]);
    }

    private function filters(Request $request): array
    {
        $validated = $request->validate([
            'search'    => ['nullable', 'string', 'max:100'],
            'work_type' => ['nullable', Rule::in(['remote', 'wfa', 'wfo', 'hybrid'])],
            'status'    => ['nullable', Rule::in(['open', 'closed'])],
        ]);

        return [
            'search'    => filled($validated['search'] ?? null) ? trim($validated['search']) : null,
            'work_type' => $validated['work_type'] ?? null,
            'status'    => $validated['status'] ?? null,
        ];
    }
}
