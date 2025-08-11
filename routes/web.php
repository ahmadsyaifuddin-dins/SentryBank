<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Teller\DashboardController as TellerDashboard;
use App\Http\Controllers\Nasabah\DashboardController as NasabahDashboard;
use App\Http\Controllers\Nasabah\DashboardController;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

// Global dashboard route (untuk route('dashboard') di Jetstream)
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    $role = Auth::user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'teller' => redirect()->route('teller.dashboard'),
        'nasabah' => redirect()->route('nasabah.dashboard'),
        default => abort(403),
    };
})->name('dashboard');

// Dashboard khusus per role
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    Route::get('/teller/dashboard', [TellerDashboard::class, 'index'])->name('teller.dashboard');
    Route::get('/nasabah/dashboard', [NasabahDashboard::class, 'index'])->name('nasabah.dashboard');
});

Route::resource('/nasabah', DashboardController::class);

Route::get('/deposit', function () {
    return view('nasabah.deposit');
})->name('nasabah.deposit');

Route::get('/withdraw', function () {
    return view('nasabah.withdraw');
})->name('nasabah.withdraw');

Route::get('/transfer', function () {
    return view('nasabah.transfer');
})->name('nasabah.transfer');

Route::post('/deposit/update', [DashboardController::class, 'deposit'])->name('nasabah.depositmoney');
Route::post('/withdraw/update', [DashboardController::class, 'withdraw'])->name('nasabah.withdrawmoney');
Route::post('/transfer/update', [DashboardController::class, 'transfer'])->name('nasabah.transfermoney');
