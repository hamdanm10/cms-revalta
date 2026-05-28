<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegistrationService
{
    public function register(array $data): User
    {
        $user = User::create([
            'name'     => trim($data['fname'].' '.$data['lname']),
            'email'    => $data['email'],
            'password' => $data['password'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        return $user;
    }
}
