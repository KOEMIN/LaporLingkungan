<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 leading-tight">
            {{ __('Detail Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white p-8 rounded-3xl shadow-2xl border border-gray-100">

                {{-- Bagian 1: Header Laporan dan Aksi --}}
                <div class="flex justify-between items-start border-b pb-4 mb-8 border-gray-200">
                    <div>
                        <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $laporan->judul }}</h1>
                        
                        {{-- Status Visual: DIUBAH KE WARNA HITAM/GELAP --}}
                        @php
                            $statusClass = [
                                'Dilaporkan' => 'bg-red-600 text-white shadow-md', // Tetap merah untuk Bahaya
                                'Diproses' => 'bg-yellow-600 text-gray-800 shadow-md',
                                'Selesai Ditangani' => 'bg-green-600 text-white shadow-md',
                            ][$laporan->status] ?? 'bg-gray-800 text-white shadow-md'; // Default ke Hitam/Gray-800
                        @endphp
                        
                        <span class="inline-block {{ $statusClass }} text-sm font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-md mt-2">
                            STATUS: {{ $laporan->status }}
                        </span>
                    </div>

                    {{-- Tombol Aksi (EDIT & HAPUS) - Hanya untuk Pelapor --}}
                    @auth
                    @if(Auth::id() === $laporan->user_id)
                        <div class="flex space-x-3 mt-1">
                            
                            {{-- 1. TOMBOL EDIT LAPORAN: DIUBAH KE WARNA HITAM/GELAP --}}
                            <a href="{{ route('laporan.edit', $laporan) }}" class="inline-flex items-center px-5 py-2.5 bg-gray-800 border border-transparent rounded-xl font-bold text-sm text-white shadow-lg hover:bg-gray-700 transition duration-150 transform hover:scale-[1.01]">
                                <svg class="w-4 h-4 mr-2" fill="none" class = "rounded-xl"stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                EDIT LAPORAN
                            </a>
                            
                            {{-- 2. Tombol Hapus (Warna Bahaya) --}}
                            <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" onsubmit="return confirm('ANDA YAKIN INGIN MENGHAPUS LAPORAN INI? Aksi ini tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2.5 bg-red-600 border border-transparent rounded-xl font-semibold text-sm text-white shadow-md hover:bg-red-700 transition duration-150">
                                    HAPUS
                                </button>
                            </form>
                        </div>
                    @endif
                    @endauth
                </div>

                {{-- Bagian 2: Konten Utama (Foto dan Deskripsi) --}}
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">
                    
                    {{-- Kolom Kiri: Foto Bukti (3/5 Lebar) --}}
                    <div class="lg:col-span-3">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Foto Bukti Kejadian</h3>
                        <div class="relative bg-gray-100 p-3 rounded-2xl shadow-xl border border-gray-200">
                            @if($laporan->foto)
                                <img src="{{ asset('storage/' . $laporan->foto) }}" 
                                     alt="Foto Laporan: {{ $laporan->judul }}" 
                                     class="w-full h-auto max-h-[70vh] object-contain rounded-xl"
                                >
                            @else
                                <div class="w-full h-96 bg-gray-200 flex flex-col items-center justify-center text-gray-500 text-xl font-semibold rounded-xl">
                                    TIDAK ADA FOTO BUKTI
                                </div>
                            @endif
                            <p class="mt-3 text-sm text-gray-500 text-center">Tampilan foto asli dari lokasi kejadian.</p>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Detail Deskripsi & Metadata (2/5 Lebar) --}}
                    <div class="lg:col-span-2 space-y-8">

                        {{-- Card Deskripsi --}}
                        <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-200 shadow-md">
                            <h3 class="text-xl font-bold text-indigo-800 mb-3 border-b border-indigo-300 pb-2">Deskripsi Kejadian</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $laporan->deskripsi }}</p>
                        </div>
                        
                        {{-- Card Metadata --}}
                        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Tambahan</h3>
                            
                            <div class="space-y-4">
                                {{-- Lokasi --}}
                                <div class="flex items-center text-gray-700 border-b pb-3">
                                    <svg class="w-6 h-6 mr-3 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                    <div>
                                        <span class="font-bold text-sm block">Lokasi:</span>
                                        <span class="text-base">{{ $laporan->lokasi }}</span>
                                    </div>
                                </div>

                                {{-- Dilaporkan Oleh --}}
                                <div class="flex items-center text-gray-700 border-b pb-3">
                                    <svg class="w-6 h-6 mr-3 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    <div>
                                        <span class="font-bold text-sm block">Pelapor:</span>
                                        <span class="text-base">{{ $laporan->user->name }}</span>
                                    </div>
                                </div>
                                
                                {{-- Waktu Laporan --}}
                                <div class="flex items-center text-gray-700">
                                    <svg class="w-6 h-6 mr-3 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h-2V9h4v8z"/></svg>
                                    <div>
                                        <span class="font-bold text-sm block">Waktu Laporan:</span>
                                        <span class="text-base">{{ $laporan->created_at->translatedFormat('l, d F Y - H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                {{-- Tombol Kembali --}}
                <div class="pt-6 border-t border-gray-200 flex justify-start mt-8">
                    <a href="{{ route('laporan.index') }}" class="inline-flex items-center px-6 py-2.5 border border-gray-400 rounded-xl shadow-md text-base font-medium text-gray-800 hover:bg-gray-100 transition duration-150 transform hover:scale-[1.01]">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Daftar Laporan
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>