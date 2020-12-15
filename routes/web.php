<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/balance', [WalletController::class, 'index'])->name('balance');
Route::get('/transfer', [WalletController::class, 'transfer'])->name('transfer');

Route::post('/user/upgrade', [TransactionController::class, 'upgrade'])->name('user.upgrade');

Route::get('/instant', [TransactionController::class, 'instant'])->name('transaction.instant');
Route::get('/scheduled', [TransactionController::class, 'scheduled'])->name('transaction.scheduled');

Route::post('/send', [TransactionController::class, 'send'])->name('transaction.send');
Route::post('/delay', [TransactionController::class, 'delay'])->name('transaction.delay');