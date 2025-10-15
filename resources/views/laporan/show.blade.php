<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">{{ $laporan->judul }}</h3>

                    <div class="mb-4">
                        <span class="inline-block bg-blue-200 text-blue-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded">
                            {{ $laporan->status }}
                        </span>
                    </div>

                    @if($laporan->foto)
                        <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Laporan" class="w-full max-w-lg mx-auto rounded-md mb-4">
                    @endif

                    <p class="text-gray-700 mb-2"><strong>Lokasi:</strong> {{ $laporan->lokasi }}</p>
                    <p class="text-gray-700 mb-4"><strong>Dilaporkan oleh:</strong> {{ $laporan->user->name }}</p>

                    <div class="prose max-w-full">
                        <p>{{ $laporan->deskripsi }}</p>
                    </div>

                    <div class="mt-6 border-t pt-4">
                        <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Kembali ke Beranda</a>

                        @can('update', $laporan)
                            <a href="{{ route('laporan.edit', $laporan->id) }}" class="text-green-600 hover:text-green-900">Edit Laporan</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>