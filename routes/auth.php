<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// All frontend authentication routes have been disabled or removed
// as the frontend does not require user accounts. 
// Admin authentication is handled separately (e.g. via Filament).

// Only keeping the logout route for safety in case a lingering session needs to end.
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
