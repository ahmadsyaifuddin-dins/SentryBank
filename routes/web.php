<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Teller\DashboardController as TellerDashboard;
use App\Http\Controllers\Nasabah\DashboardController as NasabahDashboard;
use Illuminate\Support\Facades\Auth;

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
