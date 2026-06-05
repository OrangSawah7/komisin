<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // ini buat diarahkan tp based on role yg ada yhhhh
    $role = auth()->user()->role;
    if ($role == 'admin') return redirect()->route('admin.dashboard');
    if ($role == 'artist') return redirect()->route('artist.dashboard');
    if ($role == 'customer') return redirect()->route('customer.dashboard');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute buat atmin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function (){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

// Rute buat artist coy
Route::middleware(['auth', 'role:artist'])->prefix('artist')->name('artist.')->group(function (){
    Route::get('/dashboard', function () {
        return view('artist.dashboard');
    })->name('dashboard');
});

// Rute buat customer supaya bisa mantau apa aja yg dibeli, janlup komis ya biar artist kaya
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
