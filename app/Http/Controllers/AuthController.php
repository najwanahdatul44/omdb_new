<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        app()->setLocale(session('locale', 'en'));
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => ['required', 'email', 'exists:users'],
            'password' => ['required']
        ], [
            
            'email.required'    => 'Email wajib diisi',
            'email.email'       => 'Email tidak valid',
            'email.exists'      => 'Email tidak terdaftar',
            'password.required' => 'Password wajib diisi'
        ]);

        try {
            $response = $this->authService->login($validated);

            if (!$response) {
                return redirect()->back()->with('error', 'Kredensial tidak valid!');
            }

            return redirect('/dashboard')->with('success', 'Login berhasil');

        } catch (\Throwable $th) {
            Log::error('Failed login user', [
                'line'    => $th->getLine(),
                'file'    => $th->getFile(),
                'message' => $th->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem');
        }
    }

    public function register()
    {
        app()->setLocale(session('locale', 'en'));
        return view('auth.register');
    }

    public function register_process(Request $request)
    {
        $validated = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'              => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
            ],
            'password_confirmation' => ['required']
        ], [
            'name.required'                  => 'Nama lengkap wajib diisi.',
            'name.string'                    => 'Nama lengkap harus berupa teks.',
            'name.max'                       => 'Nama lengkap maksimal 255 karakter.',
            'email.required'                 => 'Email wajib diisi.',
            'email.email'                    => 'Email tidak valid.',
            'email.max'                      => 'Email maksimal 255 karakter.',
            'email.unique'                   => 'Email sudah terdaftar.',
            'password.required'              => 'Password wajib diisi.',
            'password.confirmed'             => 'Konfirmasi password tidak cocok.',
            'password.min'                   => 'Password minimal :min karakter.',
            'password.password'              => 'Password harus memenuhi kebijakan keamanan.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.'
        ]);

        try {
            $response = $this->authService->register($validated);

            if (!$response) {
                return redirect()->back()->with('error', 'Registrasi gagal');
            }

            return redirect()->route('login')->with('success', 'Registrasi berhasil');

        } catch (\Throwable $th) {
            Log::error('Failed register user', [
                'line'    => $th->getLine(),
                'file'    => $th->getFile(),
                'message' => $th->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan sistem');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil');
    }
}