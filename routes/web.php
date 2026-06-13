<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Redirect dashboard berdasarkan role
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role == 'admin') return redirect()->route('admin.dashboard');
    if ($role == 'customer') return redirect()->route('customer.dashboard');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute buat admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function (){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

// Rute buat customer
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function (){
    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
