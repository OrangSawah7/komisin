<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

// Redirect dashboard berdasarkan role
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role == 'admin') return redirect()->route('admin.dashboard');
    if ($role == 'customer') return redirect('/');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Onboarding
Route::post('/onboarding', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'bio' => 'nullable|string|max:500',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = auth()->user();

    $avatarPath = $user->avatar;
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
    }

    $user->update([
        'name' => $request->name,
        'bio' => $request->bio,
        'avatar' => $avatarPath,
        'onboarding_completed' => true,
    ]);

    return response()->json(['success' => true]);
})->middleware('auth')->name('onboarding');

// Rute buat admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function (){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('commissions', \App\Http\Controllers\Admin\CommissionController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->only(['index', 'destroy']);
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
});

// Rute buat customer
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function (){
    Route::get('/orders/{commissionId}/create', [\App\Http\Controllers\Customer\OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders/{commissionId}', [\App\Http\Controllers\Customer\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}', [\App\Http\Controllers\Customer\OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders', [\App\Http\Controllers\Customer\OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{id}/cancel', [\App\Http\Controllers\Customer\OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/profile', [\App\Http\Controllers\Customer\ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [\App\Http\Controllers\Customer\ProfileController::class, 'update'])->name('profile.update');

    // rute buwat ambil snap token
    Route::get('/payment/{orderId}/token', [\App\Http\Controllers\PaymentController::class, 'getSnapToken'])->name('payment.token');
});



require __DIR__.'/auth.php';
