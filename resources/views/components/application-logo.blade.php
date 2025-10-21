{{-- resources/views/components/application-logo.blade.php --}}

{{-- Menggunakan tag <img> untuk memuat logo dari folder public --}}
<img 
    src="{{ asset('images/LogoLaporanLingkungan.jpg') }}" 
    alt="{{ config('app.name', 'LAPORLINGKUNGAN') }} Logo" 
    {{-- $attributes memastikan class styling (seperti h-8 w-auto) dari Navigasi tetap diterapkan --}}
    {{ $attributes->merge(['class' => 'h-8 w-auto']) }} 
>