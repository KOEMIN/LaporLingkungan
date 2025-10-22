<nav x-data="{ open: false }" class="bg-white shadow-lg border-b border-gray-100 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                {{-- Logo Aplikasi --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-8 w-auto fill-current text-indigo-600 font-extrabold" />
                    </a>
                    <span class="ml-2 text-xl font-extrabold text-gray-800 tracking-wide font-sans">Lapor Lingkungan</span> {{-- Pastikan menggunakan font-sans --}}
                </div>

                {{-- Navigasi Utama (Desktop) --}}
                {{-- Navigasi Utama (Desktop) --}}
<div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex items-center">
    
    {{-- Link Laporan (Home, untuk semua pengunjung) --}}
    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
        {{ __('Laporan') }}
    </x-nav-link>

    @auth
    {{-- Link Dashboard (Hanya untuk user login) --}}
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>

    {{-- ===== TAMBAHKAN LINK ADMIN DI SINI ===== --}}
    @if(Auth::user()->isAdmin())
        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
            {{ __('Admin Panel') }}
        </x-nav-link>
    @endif
    {{-- ======================================= --}}

    @endauth
</div>
            </div>

            {{-- Bagian Kanan (Auth Status) --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    {{-- DROPDOWN PROFIL (USER LOGIN) --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-base font-semibold text-gray-700 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-full px-4 py-2 transition duration-150 ease-in-out shadow-sm">
                                <div class="mr-2">{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Kelola Akun
                            </div>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <span class="text-red-600 font-semibold">{{ __('Log Out') }}</span>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- TOMBOL LOGIN DAN REGISTER (GUEST) - DIPERBAIKI --}}
                    <a href="{{ route('login') }}" class="font-semibold text-gray-700 hover:text-indigo-600 transition duration-150 px-3 py-2 text-base">
                        Masuk
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="font-semibold text-gray-700 hover:text-indigo-600 transition duration-150 px-3 py-2 text-base">
                        Daftar
                        </a>
                    @endif
                @endguest
            </div>

            {{-- Tombol Hamburger (Mobile) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Responsive Navigation Links (Mobile) --}}
{{-- Responsive Navigation Links (Mobile) --}}
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    @auth
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Laporan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            {{-- ===== TAMBAHKAN LINK ADMIN (MOBILE) DI SINI ===== --}}
            @if(Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Admin Panel') }}
                </x-responsive-nav-link>
            @endif
            {{-- =============================================== --}}

        </div>

            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            <span class="text-red-600 font-semibold">{{ __('Log Out') }}</span>
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            {{-- Bagian untuk Guest (Mobile) --}}
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('home')">
                    {{ __('Laporan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Masuk') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Daftar') }}
                </x-responsive-nav-link>
            </div>
        @endguest
    </div>
</nav>