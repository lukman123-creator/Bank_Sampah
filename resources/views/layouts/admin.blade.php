<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - Bank Sampah</title>
    <link rel="icon" href="{{ asset('images/logo1.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('numberCounter', (target, isCurrency = false) => ({
                count: 0, target: Number(target),
                init() {
                    let duration = 1000; let steps = 30; let stepValue = this.target / steps; let currentStep = 0;
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
        } else { document.documentElement.classList.remove('dark') }
    </script>
</head>
<body x-data="{ darkMode: localStorage.theme === 'dark', sidebarOpen: false, toggleTheme() { this.darkMode = !this.darkMode; localStorage.theme = this.darkMode ? 'dark' : 'light'; if(this.darkMode) document.documentElement.classList.add('dark'); else document.documentElement.classList.remove('dark'); } }" class="font-sans antialiased text-gray-900 dark:text-gray-100 selection:bg-emerald-500 selection:text-white">

    <div class="flex h-screen bg-gray-50 dark:bg-gray-900 overflow-hidden">
        
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 md:relative md:translate-x-0 flex flex-col">
            <div class="h-16 flex items-center px-6 border-b border-gray-200 dark:border-gray-700 shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto">
                </a>
            </div>

            <div class="overflow-y-auto flex-grow custom-scrollbar">
                <nav class="px-4 py-6 space-y-1">
                    <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Utama</p>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition-colors {{ request()->routeIs('admin.transactions.index') ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Kelola Antrean
                    </a>
                    
                    <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mt-6 mb-2">Master Data</p>
                    <a href="{{ route('admin.waste-types.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">Kelola Sampah</a>
                    <a href="{{ route('admin.rewards.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">Kelola Hadiah</a>

                    <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mt-6 mb-2">Gudang & Penjualan</p>
                    <a href="{{ route('admin.stocks.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">Kelola Stok</a>
                    <a href="{{ route('admin.sales.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">Riwayat Penjualan</a>

                    <p class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider mt-6 mb-2">Rekapitulasi</p>
                    <a href="{{ route('admin.analytics') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">Laporan Transaksi</a>
                </nav>
            </div>

            <div class="p-4 border-t border-gray-200 dark:border-gray-700 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-emerald-600 flex items-center justify-center text-white font-bold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div class="flex-1 overflow-hidden">
                        <div class="text-sm font-bold truncate">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500 truncate">Admin</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 text-gray-500 hover:text-red-600 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg></button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 flex items-center justify-between md:justify-end px-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shrink-0 z-20 shadow-sm">
                <div class="flex items-center md:hidden gap-3">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
                </div>
                <button @click="toggleTheme()" class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg x-show="darkMode" style="display: none;" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto custom-scrollbar">
                <div class="p-6 md:p-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-20 md:hidden" style="display: none;"></div>
    </div>
    <style>.custom-scrollbar::-webkit-scrollbar { width: 6px; } .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; } .dark .custom-scrollbar::-webkit-scrollbar-thumb { background: #475569; }</style>
</body>
</html>