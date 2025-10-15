<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Semua Laporan Warga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @auth
                    <a href="{{ route('laporan.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mb-4">
                        Buat Laporan Baru
                    </a>
                    @endauth

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($laporans as $laporan)
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                @if($laporan->foto)
                                    <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Laporan" class="w-full h-48 object-cover rounded-md mb-4">
                                @endif
                                <h3 class="font-bold text-lg">{{ $laporan->judul }}</h3>
                                <p class="text-sm text-gray-600">Lokasi: {{ $laporan->lokasi }}</p>
                                <p class="text-xs text-gray-500 mt-2">Dilaporkan oleh: {{ $laporan->user->name }} pada {{ $laporan->created_at->format('d M Y') }}</p>
                                <span class="inline-block bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded mt-2">
                                    {{ $laporan->status }}
                                </span>
                                <a href="{{ route('laporan.show', $laporan->id) }}" class="text-indigo-600 hover:text-indigo-900 mt-4 block">Lihat Detail</a>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Belum ada laporan yang dibuat.</p>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $laporans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>