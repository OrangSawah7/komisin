<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

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

    // biar otomatis bikin 7 route sekaligus buat crud
    Route::resource('commissions', \App\Http\Controllers\Admin\CommissionController::class);

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->only(['index', 'destroy']);
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::get('/orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
});

// Rute buat customer
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function (){
    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    })->name('dashboard');

    Route::post('/orders/{commissionId}', [\App\Http\Controllers\Customer\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}', [\App\Http\Controllers\Customer\OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{commissionId}/create', [\App\Http\Controllers\Customer\OrderController::class, 'create'])->name('orders.create');
    Route::get('/orders', [\App\Http\Controllers\Customer\OrderController::class, 'index'])->name('orders.index');

    Route::patch('/orders/{id}/cancel', [\App\Http\Controllers\Customer\OrderController::class, 'cancel'])->name('orders.cancel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
