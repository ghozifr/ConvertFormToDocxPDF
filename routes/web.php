<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocxController;
use App\Http\Controllers\ProfileController;

Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::get('/form/preview/{id}', [DocxController::class, 'previewDocx'])->middleware('auth')->name('form.preview');


// Redirect user to the appropriate page based on their authentication status
Route::get('/', function () {
    // Check if the user is authenticated
    if (auth()->check()) {
        // If authenticated, redirect to the /form page
        return redirect()->route('form');
    } else {
        // If not authenticated, redirect to the registration page
        return redirect()->route('login');
    }
})->name('home');

// Only authenticated users can access the form
Route::get('/form', function () {
    return view('form');
})->middleware(['auth'])->name('form');


// Convert form data to DOCX
Route::post('/convert', [DocxController::class, 'convertToDocx'])->middleware(['auth'])->name('form.convert');

// Default Jetstream auth routes for dashboard (optional)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
