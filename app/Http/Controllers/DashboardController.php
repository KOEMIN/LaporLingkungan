<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Cek apakah user adalah Admin
        if ($user && $user->isAdmin()) {
            // == LOGIKA UNTUK ADMIN ==
            // Hitung SEMUA laporan
            $totalLaporan = Laporan::count();
            // Hitung SEMUA laporan yang 'Diproses'
            $sedangDiproses = Laporan::where('status', 'Diproses')->count();
            // Hitung SEMUA laporan yang 'Selesai Ditangani'
            $sudahSelesai = Laporan::where('status', 'Selesai Ditangani')->count();

        } else {
            // == LOGIKA UNTUK USER BIASA (seperti sebelumnya) ==
            $userId = $user->id; // Ambil ID user yang sedang login

            // Hitung semua laporan MILIK user ini
            $totalLaporan = Laporan::where('user_id', $userId)->count();
            // Hitung laporan MILIK user ini yang 'Diproses'
            $sedangDiproses = Laporan::where('user_id', $userId)->where('status', 'Diproses')->count();
            // Hitung laporan MILIK user ini yang 'Selesai Ditangani'
            $sudahSelesai = Laporan::where('user_id', $userId)->where('status', 'Selesai Ditangani')->count();
        }

        // Kirim data hitungan ke view (view-nya tetap sama)
        return view('dashboard', [
            'totalLaporan' => $totalLaporan,
            'sedangDiproses' => $sedangDiproses,
            'sudahSelesai' => $sudahSelesai,
        ]);
    }
}