<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 

class AuthService
{
    public function login($data)
    {
        $user = User::where('email', $data['email'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            Auth::login($user);
            return true;
        }

        return false;
    }

    public function register($data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return $user ? true : false;
    }
}