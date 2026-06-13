<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommissionController extends Controller
{
    // ->commissions = ngambil semua komisi punyanya profil artist nya
    public function index(){
        $commissions = auth()->user()->artistProfile->commissions;
        return view('artist.commissions.index', compact('commissions'));
    }
}
