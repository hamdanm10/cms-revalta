<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\JsonResponse;

class RegistrationsController extends Controller
{
    public function __construct(
        private RegistrationService $registrationService,
    ) {}

    public function store(RegisterRequest $request): JsonResponse
    {
        $user = $this->registrationService->register($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Registration successful.',
            'data'    => [
                'user' => [
                    'name'  => $user->name,
                    'email' => $user->email,
                ],
            ],
        ], 201);
    }
}
