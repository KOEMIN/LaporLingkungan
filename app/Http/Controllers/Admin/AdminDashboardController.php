<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan; // <-- Tambahkan ini
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil SEMUA laporan, urutkan dari yang terbaru
        $laporans = Laporan::latest()->get(); 

        // Kirim data ke view admin.dashboard
        return view('admin.dashboard', compact('laporans'));
    }
}