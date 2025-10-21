<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    // 🔹 Menampilkan semua laporan di halaman utama
    public function index()
    {
        $laporans = Laporan::latest()->paginate(6);
        return view('home', compact('laporans'));
    }

    // 🔹 Menampilkan form membuat laporan baru
    public function create()
    {
        return view('laporan.create');
    }

    // 🔹 Menyimpan laporan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $fotoPath = $request->hasFile('foto')
            ? $request->file('foto')->store('foto_laporan', 'public')
            : null;

        // ✅ Status default disesuaikan dengan enum di database
        Laporan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'status' => 'Dilaporkan',
            'foto' => $fotoPath,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dikirim!');
    }

    // 🔹 Menampilkan detail laporan
    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('laporan.show', compact('laporan'));
    }

    // 🔹 Menampilkan form edit laporan
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('laporan.edit', compact('laporan'));
    }

    // 🔹 Update laporan
    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|string|in:Dilaporkan,Diproses,Selesai Ditangani',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Jika ada foto baru, hapus foto lama dan upload baru
        if ($request->hasFile('foto')) {
            if ($laporan->foto && Storage::disk('public')->exists($laporan->foto)) {
                Storage::disk('public')->delete($laporan->foto);
            }
            $laporan->foto = $request->file('foto')->store('foto_laporan', 'public');
        }

        // Update data laporan
        $laporan->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
            'foto' => $laporan->foto,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    // 🔹 Hapus laporan
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);

        if ($laporan->foto && Storage::disk('public')->exists($laporan->foto)) {
            Storage::disk('public')->delete($laporan->foto);
        }

        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }
}
