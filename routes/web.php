<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SalesProgramController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UserController;
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

    // Role-Based Access Control
    // Admin-only routes
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('menus', MenuController::class);
        Route::resource('payments', PaymentController::class);
        Route::resource('inventories', InventoryController::class);
    });

    // Owner-only routes
    Route::middleware('role:owner')->group(function () {
        Route::resource('sales-reports', SalesReportController::class); // Sales reports
        Route::resource('sales-programs', SalesProgramController::class); // Sales programs
    });

    // Waiters-only routes
    Route::middleware('role:waiters')->group(function () {
        Route::resource('reservations', ReservationController::class); // Reservations
    });

    // Waiters-Cleaner routes
    Route::middleware('role:waiters,cleaner')->group(function () {
        Route::resource('tables', TableController::class); // Table management
    });

    // Cook-Waiters routes
    Route::middleware('role:waiters,cook')->group(function () {
        Route::resource('orders', OrderController::class); // Orders
    });
});

// Auth Routes
require __DIR__.'/auth.php';
