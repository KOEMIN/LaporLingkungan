<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil data sesuai status
        $totalLaporan = Laporan::where('user_id', $userId)->count();
        $laporanDiproses = Laporan::where('user_id', $userId)
            ->where('status', 'Diproses')
            ->count();
        $laporanSelesai = Laporan::where('user_id', $userId)
            ->where('status', 'Selesai')
            ->count();

        // Kirim ke view
        return view('dashboard', compact('totalLaporan', 'laporanDiproses', 'laporanSelesai'));
    }
}
