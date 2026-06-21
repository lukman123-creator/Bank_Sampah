<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bank Sampah') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('images/logo1.png') }}" type="image/png">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('numberCounter', (target, isCurrency = false) => ({
                count: 0, target: Number(target),
                init() {
                    let duration = 1500; let steps = 60; let stepValue = this.target / steps; let currentStep = 0;
                    let interval = setInterval(() => {
                        currentStep++; this.count = Math.floor(stepValue * currentStep);
                        if (currentStep >= steps) { this.count = this.target; clearInterval(interval); }
                    }, duration / steps);
                },
                formatted() { return isCurrency ? new Intl.NumberFormat('id-ID').format(this.count) : this.count; }
            }))
        });

        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body x-data="{ 
        darkMode: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
        mobileMenuOpen: false,
        toggleTheme() {
            this.darkMode = !this.darkMode;
            if (this.darkMode) { document.documentElement.classList.add('dark'); localStorage.theme = 'dark'; } 
            else { document.documentElement.classList.remove('dark'); localStorage.theme = 'light'; }
        }
    }" 
    class="font-sans antialiased bg-gray-50 dark:bg-[#0a110d] text-gray-900 dark:text-gray-100 flex flex-col min-h-screen selection:bg-green-500 selection:text-white transition-colors duration-300">

    <div class="fixed inset-0 z-[-1] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <div class="absolute inset-0 bg-white/95 dark:bg-gradient-to-b dark:from-[#0a110d]/90 dark:via-[#0a110d]/80 dark:to-[#0a110d] backdrop-blur-[2px]"></div>
    </div>

    <nav class="bg-white/80 dark:bg-[#0a110d]/80 backdrop-blur-xl border-b border-gray-200 dark:border-white/10 sticky top-0 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
                    </a>
                    
                    <div class="hidden md:flex ml-8 space-x-2">
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('dashboard') ? 'bg-green-50 dark:bg-[#108945]/20 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/5' }}">Dashboard</a>
                        <a href="{{ route('transactions.index') }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('transactions.*') ? 'bg-green-50 dark:bg-[#108945]/20 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/5' }}">Transaksi</a>
                        <a href="{{ route('katalog.index') }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('katalog.*') ? 'bg-green-50 dark:bg-[#108945]/20 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/5' }}">Katalog Hadiah</a>
                        <a href="{{ route('panduan') }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('panduan') ? 'bg-green-50 dark:bg-[#108945]/20 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-white/5' }}">Panduan</a>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-4">
                    <button @click="toggleTheme()" class="p-2.5 rounded-full bg-gray-100 dark:bg-white/5 text-gray-500 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-white/10 transition-colors">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <svg x-show="darkMode" style="display: none;" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 px-2 py-1.5 rounded-full hover:bg-gray-100 dark:hover:bg-white/5 transition border border-transparent dark:hover:border-white/10">
                            <div class="w-9 h-9 rounded-full bg-green-600 flex items-center justify-center text-white font-bold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <span class="text-sm font-bold text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="open" style="display: none;" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 py-2 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5">Pengaturan Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/10 font-bold">Log Out</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="md:hidden flex items-center gap-2">
                    <button @click="toggleTheme()" class="p-2 text-gray-500 dark:text-gray-300">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <svg x-show="darkMode" style="display: none;" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-gray-500 dark:text-gray-300 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen" style="display: none;" class="md:hidden bg-white/95 dark:bg-[#0a110d]/95 backdrop-blur-xl border-b border-gray-200 dark:border-white/10 px-4 py-4 space-y-2 absolute w-full left-0 shadow-lg">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl font-bold {{ request()->routeIs('dashboard') ? 'bg-green-50 dark:bg-[#108945]/20 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-300' }}">Dashboard</a>
            <a href="{{ route('transactions.index') }}" class="block px-4 py-3 rounded-xl font-bold {{ request()->routeIs('transactions.*') ? 'bg-green-50 dark:bg-[#108945]/20 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-300' }}">Transaksi</a>
            <a href="{{ route('katalog.index') }}" class="block px-4 py-3 rounded-xl font-bold {{ request()->routeIs('katalog.*') ? 'bg-green-50 dark:bg-[#108945]/20 text-green-700 dark:text-green-400' : 'text-gray-600 dark:text-gray-300' }}">Katalog Hadiah</a>
            <hr class="border-gray-200 dark:border-gray-700 my-2">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 rounded-xl font-bold text-gray-600 dark:text-gray-300">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 rounded-xl font-bold text-red-500">Log Out</button>
            </form>
        </div>
    </nav>

    <main class="flex-1 w-full max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 z-10 relative">
        @isset($header)
            <header class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $header }}</h2>
            </header>
        @endisset
        {{ $slot }}
    </main>

</body>
</html>