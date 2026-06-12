<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtistProfileController extends Controller
{
    // ============== SHOW =======================
    // buat nampilin profil artist nya
    // auth()->user = ini buat ambil user yg lagi login
    // ->artistProfile = ini ambil profil artist punyanya
    // compact('profile') = ini buat ngirim data $profile ke view
    public function show(){
        $profile = auth()->user()->artistProfile;
        return view('artist.profile', compact('profile'));
    }

    // =================== EDIT ==================
    public function edit(){
        $profile = auth()->user()->artistProfile;
        return view('artist.profile-edit', compact('profile'));
    }

    // =================== UPDATE ==================
    public function update(Request $request){
        $request->validate([
            'display_name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        // kalaw profil dah ada, apdet. kalaw profil blm ada, buat baruw
        $user->artistProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only(['display_name', 'bio', 'instagram', 'twitter'])
        );

        return redirect()->route('artist.profile')->with('success', 'Artist Profile Updated Successfully');
    }
}
