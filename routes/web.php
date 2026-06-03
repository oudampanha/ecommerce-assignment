<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyMailController;
use App\Http\Controllers\Auth\EmailVerificationController;

Route::get('/', function () {
  return view('welcome');
});

// Route::get('/sendmail', function () {
//   $message = "Hello, Welcome to Laravel 10!";
//   Mail::to('learningai514@gmail.com')->send(new \App\Mail\SendVerifyMail($message));
//   return "Email Sent Successfully";
// });

Route::middleware('auth')->group(function () {
  // Email verification routes
  Route::get('/verify-email', [EmailVerificationController::class, 'show'])
    ->name('verification.code.show');

  Route::post('/verify-email', [EmailVerificationController::class, 'verify'])
    ->name('verification.code.verify');

  Route::post('/resend-verification-code', [EmailVerificationController::class, 'resend'])
    ->name('verification.code.resend');

  // Protected routes
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->middleware('verified')->name('dashboard');
});

Route::get('/sendmail', [VerifyMailController::class, 'index']);

Route::get('/create-storage-link', function () {
  try {
    Artisan::call('storage:unlink');
    Artisan::call('storage:link');
    return 'Storage link has been created.';
  } catch (\Exception $e) {
    return 'Error creating storage link: ' . $e->getMessage();
  }
});

// User routes with DataTables
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/data', [UserController::class, 'getData'])->name('users.data');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
