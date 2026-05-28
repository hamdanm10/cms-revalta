<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function __construct(private RegistrationService $registrationService) {}

    public function create(): View
    {
        return view('pages.registrations.create');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $this->registrationService->register($request->validated());

        return redirect()->route('admin.dashboard');
    }
}
