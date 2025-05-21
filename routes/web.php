<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DocumentController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Middleware\UserMiddleware;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\Auth\AdminDashboardController;
use App\Http\Controllers\Auth\UserProfileController;

// Redirect root URL to user login
Route::get('/', function () {
    return redirect()->route('user.login'); // Redirects to /user/login
});

// User login/logout routes under /user
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/register', [RegisterController::class, 'showform'])->name('custom.register');
Route::post('/register', [RegisterController::class, 'register'])->name('custom.register.submit');

// Forgot Password
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Routes protected by 'user' middleware
    Route::middleware(['user'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        // Profile edit/update
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

        // Document Upload
        Route::get('/documents/upload', [DocumentController::class, 'create'])->name('documents.upload');
        Route::post('/documents/store', [DocumentController::class, 'store'])->name('documents.store');

    });
// Route::middleware('auth')->group(function () {
//     Route::post('/documents/store', [DocumentController::class, 'store'])->name('documents.store');
//     Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');
// });php artisan make:migration create_documents_table

Route::middleware(['auth'])->group(function () {
    Route::post('/upload-proof', [UserController::class, 'uploadProof'])->name('proof.upload');
});

Route::post('/profile/upload-picture', [UserProfileController::class, 'uploadProfilePicture'])->name('profile.picture.upload');
Route::delete('/profile/remove-picture', [UserProfileController::class, 'removeProfilePicture'])->name('profile.picture.remove');


Route::prefix('admin')->group(function () {
    // Admin login routes
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // Routes protected by auth:admin middleware
    Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');


        // Admin logout
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        
        Route::post('/admin/verify', [AdminDashboardController::class, 'verify'])->name('admin.verify');

        // View users + documents route
        Route::get('users', [AdminAuthController::class, 'viewUsers'])->name('admin.users');
    });
});



Route::middleware(['auth'])->group(function () {
    Route::post('/documents/store', [DocumentController::class, 'store'])->name('documents.store');
});
