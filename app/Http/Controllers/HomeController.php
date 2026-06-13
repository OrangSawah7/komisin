<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $commissions = \App\Models\Commission::where('status', 'approved')->get();
        return view('welcome', compact('commissions'));
    }
}
