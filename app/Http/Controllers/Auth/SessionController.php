<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\SessionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SessionController extends Controller
{
    public function __construct(private SessionService $sessionService) {}

    public function create(): View
    {
        return view('pages.sessions.create');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $this->sessionService->login(
            $request->validated(),
            $request->boolean('remember')
        );

        return redirect()->intended(route('admin.dashboard'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $this->sessionService->logout($request);

        return redirect()->route('session.create');
    }
}
