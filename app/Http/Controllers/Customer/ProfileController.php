<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $orders = \App\Models\Order::where('customer_id', auth()->user()->id)
            ->with('commission')
            ->latest()
            ->get();
        return view('customer.profile', compact('orders'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();

        // upload avatar kalau ada
        $avatarPath = $user->avatar;
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                \Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('customer.profile')->with('success', 'Profil berhasil diupdate!');
    }
}
