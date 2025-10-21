<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900 leading-tight">
            {{ __('Semua Laporan Warga') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ✅ Pesan sukses (setelah update/tambah/hapus laporan) --}}
            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tombol Buat Laporan --}}
            @auth
                <div class="flex justify-end mb-8">
                    <a href="{{ route('laporan.create') }}"
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-700 text-white font-semibold rounded-full shadow-md hover:shadow-lg hover:scale-[1.03] transition transform duration-200 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 4v16m8-8H4"></path>
                        </svg>
                        Buat Laporan Baru
                    </a>
                </div>
            @endauth

            {{-- Daftar Laporan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($laporans as $laporan)
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transform hover:scale-[1.02] transition duration-300 group">
                        
                        {{-- Foto laporan --}}
                        @if($laporan->foto)
                            <img src="{{ asset('storage/' . $laporan->foto) }}"
                                 alt="Foto Laporan {{ $laporan->judul }}"
                                 class="w-full h-48 object-cover group-hover:opacity-95 transition duration-300">
                        @else
                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 italic">
                                Tidak ada foto
                            </div>
                        @endif

                        {{-- Konten laporan --}}
                        <div class="p-6">
                            <h3 class="font-extrabold text-xl text-gray-800 mb-1">{{ $laporan->judul }}</h3>
                            <p class="text-sm text-gray-600 mb-2">📍 {{ $laporan->lokasi }}</p>

                            <p class="text-xs text-gray-500 mb-3">
                                Oleh <span class="font-semibold text-gray-700">{{ $laporan->user->name }}</span> •
                                {{ $laporan->created_at->format('d M Y') }}
                            </p>

                            {{-- Status laporan --}}
                            @php
                                $statusColors = [
                                    'Selesai' => 'bg-green-100 text-green-700',
                                    'Diproses' => 'bg-yellow-100 text-yellow-700',
                                    'Pending' => 'bg-red-100 text-red-700',
                                    'default' => 'bg-gray-100 text-gray-700',
                                ];
                                $statusColor = $statusColors[$laporan->status] ?? $statusColors['default'];
                            @endphp

                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                {{ $laporan->status }}
                            </span>

                            {{-- Tombol detail --}}
                            <div class="mt-5">
                                <a href="{{ route('laporan.show', $laporan->id) }}"
                                   class="inline-flex items-center text-emerald-700 font-semibold hover:text-emerald-800 hover:underline transition duration-200">
                                    <span>Lihat Detail</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500 text-lg mt-10">
                        Belum ada laporan yang dibuat 😢
                    </p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-10 flex justify-center">
                {{ $laporans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
