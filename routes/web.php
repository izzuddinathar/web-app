<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\SalesProgramController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Home & Dashboard
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Role-Based Access Control
    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        // Route::resource('menus', MenuController::class); // Menu management
    });

    // Owner-only routes
    Route::middleware('role:owner')->group(function () {
        // Route::resource('sales-reports', SalesReportController::class); // Sales reports
        // Route::resource('sales-programs', SalesProgramController::class); // Sales programs
    });

    // Waiters-only routes
    Route::middleware('role:waiters')->group(function () {
        // Route::resource('tables', TableController::class); // Table management
        // Route::resource('reservations', ReservationController::class); // Reservations
        // Route::resource('orders', OrderController::class); // Orders
    });

    // Cook-only routes
    Route::middleware('role:cook')->group(function () {
        // Route::resource('orders', OrderController::class); // Orders
    });

    // Cleaner-only routes
    Route::middleware('role:cleaner')->group(function () {
        // Route::resource('tables', TableController::class); // Manage tables
    });
});

// Auth Routes
require __DIR__.'/auth.php';
