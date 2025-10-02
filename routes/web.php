<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\AdminController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // User registrations
    Route::resource('registrations', RegistrationController::class);
    Route::patch('/registrations/{registration}/cancel', [RegistrationController::class, 'cancel'])
        ->name('registrations.cancel');

    // Certificate view/download for user
    Route::get('/registrations/{registration}/certificate', [RegistrationController::class, 'certificate'])
        ->name('registrations.certificate');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/registrations/{registration}/certificate', [AdminController::class, 'certificate'])->name('registrations.certificate');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/registrations', [AdminController::class, 'registrations'])->name('registrations');
    Route::get('/registrations/{registration}/schedule', [AdminController::class, 'scheduleRegistration'])
        ->name('registrations.schedule');
    Route::patch('/registrations/{registration}/schedule', [AdminController::class, 'updateSchedule'])
        ->name('registrations.update-schedule');
    Route::patch('/registrations/{registration}/complete', [AdminController::class, 'completeRegistration'])->name('registrations.complete');
    Route::resource('centers', \App\Http\Controllers\Admin\CenterController::class);
    Route::resource('vaccines', \App\Http\Controllers\Admin\VaccineController::class);
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
});
