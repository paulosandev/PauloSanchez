<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users/export/csv', [DashboardController::class, 'exportCsv'])->name('users.export.csv');
    Route::get('/users/export/pdf', [DashboardController::class, 'exportPdf'])->name('users.export.pdf');
    Route::put('/users/{id}', [DashboardController::class, 'updateUser'])->name('user.update');
});


Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('/', [RegisterController::class, 'create']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
