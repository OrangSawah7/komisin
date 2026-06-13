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
        // mastiin data yg masuk dah bener apa belom
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
        ]);

        // nyimpen ke debe
        Commission::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'status' => 'approved',
        ]);

        // habis disimpen, balik lagi ke halaman komisi
        return redirect()->route('admin.commissions.index')->with('success', 'komisi berhasil ditambahkan!');
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
        ]);

        // apdet komisi yg dah ada di debe
        $commission->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
        ]);

        return redirect()->route('admin.commissions.index')->with('success', 'Komisi berhasil diupdate!');
    }

    public function destroy(Commission $commission)
    {
        $commission->delete();
        return redirect()->route('admin.commissions.index')->with('success', 'Komisi berhasil dihapus!');
    }
}
