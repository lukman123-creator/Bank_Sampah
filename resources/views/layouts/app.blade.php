<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('numberCounter', (target, isCurrency = false) => ({
                count: 0,
                target: Number(target),
                init() {
                    let duration = 1500; // 1.5 seconds
                    let steps = 60;
                    let stepValue = this.target / steps;
                    let currentStep = 0;
                    let interval = setInterval(() => {
                        currentStep++;
                        this.count = Math.floor(stepValue * currentStep);
                        if (currentStep >= steps) {
                            this.count = this.target;
                            clearInterval(interval);
                        }
                    }, duration / steps);
                },
                formatted() {
                    if (isCurrency) {
                        return new Intl.NumberFormat('id-ID').format(this.count);
                    }
                    return this.count;
                }
            }))
        });

        // Pre-load Dark Mode to prevent FOUC
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body x-data="{ 
        darkMode: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
        toggleTheme() {
            this.darkMode = !this.darkMode;
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            }
        }
    }" 
    class="font-sans antialiased bg-gray-50 dark:bg-[#0a110d] text-gray-900 dark:text-gray-100 flex min-h-screen selection:bg-green-500 selection:text-white transition-colors duration-300">

    <!-- Background Image & Gradient -->
    <div class="fixed inset-0 z-[-1] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <div class="absolute inset-0 bg-white/95 dark:bg-gradient-to-b dark:from-[#0a110d]/90 dark:via-[#0a110d]/70 dark:to-[#0a110d] backdrop-blur-[2px] transition-colors duration-300"></div>
    </div>

    <!-- Mobile Sidebar Overlay & Toggle (Alpine.js) -->
    <div x-data="{ sidebarOpen: false }" class="flex w-full min-h-screen">
        
        <!-- Mobile Header -->
        <div class="md:hidden flex items-center justify-between p-4 bg-white/80 dark:bg-[#0a110d]/80 backdrop-blur-md text-gray-900 dark:text-white w-full absolute top-0 z-20 border-b border-gray-200 dark:border-white/5 animate-fadeIn transition-colors duration-300">
            <div class="font-bold text-xl flex items-center gap-2 text-green-600 dark:text-green-400">
                ♻️ Bank Sampah
            </div>
            <div class="flex items-center gap-3">
                <button @click="toggleTheme()" class="p-2 rounded-xl bg-gray-100 dark:bg-white/5 text-gray-500 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-white/10 transition-colors">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg x-show="darkMode" style="display: none;" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>

        <!-- Sidebar -->
        <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" class="absolute md:relative z-20 w-64 min-h-screen bg-white/80 dark:bg-[#0a110d]/80 backdrop-blur-xl text-gray-900 dark:text-white flex flex-col transition-all duration-300 md:translate-x-0 pt-16 md:pt-0 border-r border-gray-200 dark:border-white/10 animate-slideUp">
            
            <div class="p-8 hidden md:flex items-center gap-3">
                <span class="text-3xl text-green-600 dark:text-green-500">♻️</span>
                <span class="font-bold text-xl tracking-wide">Bank Sampah</span>
            </div>

            <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2 mt-4 md:mt-0">
                Main Menu
            </div>

            <nav class="flex-1 px-4 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-green-50 dark:bg-[#108945]/20 text-green-700 dark:text-green-400 border-green-200 dark:border-green-500/30' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white border-transparent' }} rounded-2xl font-medium shadow-sm border transition-colors">
                    <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                <!-- Transaksi -->
                <a href="{{ route('transactions.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('transactions.*') ? 'bg-green-50 dark:bg-[#108945]/20 text-green-700 dark:text-green-400 border-green-200 dark:border-green-500/30' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white border-transparent' }} rounded-2xl font-medium transition-colors border">
                    <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    Transaksi
                </a>

                <!-- Katalog Hadiah -->
                <a href="{{ route('katalog.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('katalog.*') ? 'bg-green-50 dark:bg-[#108945]/20 text-green-700 dark:text-green-400 border-green-200 dark:border-green-500/30' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white border-transparent' }} rounded-2xl font-medium transition-colors border">
                    <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Katalog Hadiah
                </a>

                <!-- Panduan -->
                <a href="{{ route('panduan') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('panduan') ? 'bg-green-50 dark:bg-[#108945]/20 text-green-700 dark:text-green-400 border-green-200 dark:border-green-500/30' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white border-transparent' }} rounded-2xl font-medium transition-colors border">
                    <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 62v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Panduan
                </a>
            </nav>

            <div class="p-6 mt-auto">
                <div class="bg-gray-100 dark:bg-white/5 rounded-2xl p-4 flex flex-col gap-3 border border-gray-200 dark:border-white/10 transition-colors">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-full bg-green-600 dark:bg-[#108945] flex items-center justify-center text-white font-bold group-hover:scale-105 transition-transform">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <div class="text-sm font-bold text-gray-900 dark:text-white truncate group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</div>
                        </div>
                    </a>
                    
                    <div class="h-px w-full bg-gray-200 dark:bg-white/10 my-1 transition-colors"></div>

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2 text-red-500 dark:text-red-400 hover:text-red-600 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-500/10 p-2 rounded-xl transition-colors text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 w-full relative overflow-y-auto mt-14 md:mt-0 transition-colors duration-300">
            <!-- Desktop Theme Toggle (Always visible on desktop) -->
            <div class="hidden md:flex justify-end p-6 absolute top-0 right-0 z-20">
                <button @click="toggleTheme()" class="p-2.5 rounded-full bg-white/80 dark:bg-[#0a110d]/80 backdrop-blur-md text-gray-500 dark:text-gray-300 hover:bg-white dark:hover:bg-white/10 transition-colors border border-gray-200 dark:border-white/10 shadow-sm">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg x-show="darkMode" style="display: none;" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>
            </div>

            <!-- Page Heading (Optional) -->
            @isset($header)
                <header class="bg-white/40 dark:bg-[#0a110d]/40 backdrop-blur-md border-b border-gray-200 dark:border-white/5 shadow-sm sticky top-0 z-10 hidden md:block transition-colors duration-300">
                    <div class="px-6 md:px-10 py-6 flex justify-between items-center">
                        <div class="text-gray-900 dark:text-white pr-16">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset


            <div class="p-6 md:p-10 lg:p-12 h-full z-10 relative">
                {{ $slot }}
            </div>
        </main>

        <!-- Overlay to close sidebar on mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-10 md:hidden" style="display: none;"></div>
    </div>
</body>
</html>
