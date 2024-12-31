<?php

namespace App\Http\Controllers;

use App\Models\Mobil;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMobils = Mobil::count();
        $totalMobilsDisewa = Mobil::where('status', 'disewa')->count(); // Misalkan Anda memiliki kolom 'status'
        $latestMobils = Mobil::orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard.index', compact('totalMobils', 'totalMobilsDisewa', 'latestMobils'));
    }
}