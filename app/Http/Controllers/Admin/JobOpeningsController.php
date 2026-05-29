<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJobOpeningRequest;
use App\Models\JobOpening;
use App\Repositories\JobOpeningRepository;
use App\Services\Admin\JobOpeningService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class JobOpeningsController extends Controller
{
    public function __construct(
        private JobOpeningRepository $repository,
        private JobOpeningService $service,
    ) {}

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

        return response()->view('components.admin.job-openings.partials.results', [
            'jobOpenings' => $this->repository->paginate($search, $workType, $status),
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.job-openings.create', [
            'title' => 'Create Job Opening',
        ]);
    }

    public function store(StoreJobOpeningRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());

        return redirect()->route('admin.job-openings.index')
            ->with('toast', ['type' => 'success', 'message' => 'Job opening created successfully.']);
    }

    public function destroy(JobOpening $jobOpening): RedirectResponse
    {
        $this->service->destroy($jobOpening);

        return redirect()->route('admin.job-openings.index')
            ->with('toast', ['type' => 'success', 'message' => 'Job opening deleted successfully.']);
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
