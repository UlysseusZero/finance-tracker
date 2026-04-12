<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpensePaymentController;
use App\Http\Controllers\SalaryController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect()->route('login');
});

// Auth routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/salary', [SalaryController::class, 'index'])->name('salary.index');
Route::post('/salary', [SalaryController::class, 'store'])->name('salary.store');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::resource('expenses', ExpenseController::class);
    Route::post('/expense-payments', [ExpensePaymentController::class, 'store'])
        ->name('expense_payments.store');
    Route::delete('/expense-payments/{payment}', [ExpensePaymentController::class, 'destroy'])
        ->name('expense_payments.destroy');
});