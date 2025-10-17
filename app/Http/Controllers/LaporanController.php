<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;




class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = Laporan::latest()->paginate(10); // Ambil semua laporan, urutkan dari terbaru
        return view('home', compact('laporans')); // Kirim data ke view 'home'
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laporan.create'); // Menampilkan form
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Foto opsional, maks 2MB
        ]);

        // Proses upload foto jika ada
        if ($request->hasFile('foto')) {
    // Simpan file dan dapatkan path lengkapnya (misal: fotos_laporan/nama.jpg)
    $path = $request->file('foto')->store('fotos_laporan', 'public');
    // Simpan path lengkap tersebut ke array validated
    $validated['foto'] = $path; // <-- PERBAIKAN DI SINI
}

        // Tambahkan user_id dari user yang sedang login
        $validated['user_id'] = Auth::id();

        Laporan::create($validated);

        return redirect()->route('home')->with('success', 'Laporan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        $this->authorize('update', $laporan); // Cek policy
        return view('laporan.edit', ['laporan' => $laporan]);
    }

    public function update(Request $request, Laporan $laporan)
    {
        $this->authorize('update', $laporan); // Cek policy

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Dilaporkan,Diproses,Selesai Ditangani',
        ]);

        if ($request->hasFile('foto')) {
    // ... (kode hapus foto lama)
        $path = $request->file('foto')->store('fotos_laporan', 'public');
        $validated['foto'] = $path; // <-- PERBAIKAN DI SINI
}

        $laporan->update($validated);

        return redirect()->route('laporan.show', $laporan)->with('success', 'Laporan berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
{
    $this->authorize('delete', $laporan); // Cek policy

    // Hapus foto dari storage
    if ($laporan->foto) {
        Storage::delete('public/fotos_laporan/' . $laporan->foto);
    }

    $laporan->delete();

    return redirect()->route('home')->with('success', 'Laporan berhasil dihapus!');
}
}
