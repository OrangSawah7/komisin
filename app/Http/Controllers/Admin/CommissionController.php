<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    // ini method buat nampilin semua komisi yg ada
    // commission:all() -> buat ngambil semua data komisi dari debe
    // compact('commissions') -> buat ngirim data ke view nya
    public function index(){
        $commissions = Commission::all();
        return view('admin.commissions.index', compact('commissions'));
    }

    public function create(){
        return view('admin.commissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload foto kalau ada
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('commissions', 'public');
        }

        Commission::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'thumbnail' => $thumbnailPath,
            'status' => 'approved',
        ]);

        return redirect()->route('admin.commissions.index')->with('success', 'Komisi berhasil ditambahkan!');
    }

    // larapel otomatis nyari data komisi based on ID yg ada di URL, ini namanya ROute Model Binding
    public function edit(Commission $commission){
        return view('admin.commissions.edit', compact('commission'));
    }

    public function update(Request $request, Commission $commission)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload foto baru kalau ada
        $thumbnailPath = $commission->thumbnail;
        if ($request->hasFile('thumbnail')) {
            // hapus foto lama kalau ada
            if ($commission->thumbnail) {
                \Storage::disk('public')->delete($commission->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('commissions', 'public');
        }

        $commission->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('admin.commissions.index')->with('success', 'Komisi berhasil diupdate!');
    }

    public function destroy(Commission $commission)
    {
        $commission->delete();
        return redirect()->route('admin.commissions.index')->with('success', 'Komisi berhasil dihapus!');
    }
}
