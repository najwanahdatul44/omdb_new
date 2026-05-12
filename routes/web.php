<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.post'); 
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_process'])->name('signup');

Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
        session()->save();
    }
    return redirect()->back();
})->name('language.switch');

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/favorites', function () {
    return view('favorit.favorites');
});

Route::get('/search', function () {
    return view('search.search');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');