<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('laporan.update', $laporan->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="judul" :value="__('Judul Laporan')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul', $laporan->judul)" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" rows="4" required>{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="lokasi" :value="__('Lokasi Kejadian')" />
                            <x-text-input id="lokasi" class="block mt-1 w-full" type="text" name="lokasi" :value="old('lokasi', $laporan->lokasi)" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select name="status" id="status" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Dilaporkan" @selected($laporan->status == 'Dilaporkan')>Dilaporkan</option>
                                <option value="Diproses" @selected($laporan->status == 'Diproses')>Diproses</option>
                                <option value="Selesai Ditangani" @selected($laporan->status == 'Selesai Ditangani')>Selesai Ditangani</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="foto" :value="__('Ganti Foto (Opsional)')" />
                            <input id="foto" class="block mt-1 w-full" type="file" name="foto">
                            @if($laporan->foto)
                            <p class="text-sm mt-2">Foto saat ini:</p>
                            <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto saat ini" class="w-48 h-auto rounded-md">
                            @endif
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update Laporan') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <div class="mt-6 border-t pt-4">
                         <form method="POST" action="{{ route('laporan.destroy', $laporan->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit">
                                Hapus Laporan
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>