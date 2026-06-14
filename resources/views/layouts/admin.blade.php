<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Pre-load Dark Mode to prevent FOUC -->
    <script>
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
                ♻️ AdminPanel
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
                <span class="font-bold text-xl tracking-wide">AeuxAdmin</span>
            </div>

            <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                Navigation
            </div>

            <nav class="flex-1 px-4 space-y-2">
                <!-- Active Link -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-green-50 dark:bg-[#108945]/20 text-green-700 dark:text-green-400 rounded-2xl font-medium shadow-sm border border-green-200 dark:border-green-500/30 transition-colors">
                    <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                <!-- Inactive Link -->
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-gray-900 dark:hover:text-white rounded-2xl font-medium transition-colors border border-transparent">
                    <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Analytics
                </a>
            </nav>

            <div class="p-6 mt-auto">
                <div class="bg-gray-100 dark:bg-white/5 rounded-2xl p-4 flex items-center gap-3 border border-gray-200 dark:border-white/10 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-green-600 dark:bg-[#108945] flex items-center justify-center text-white font-bold transition-colors">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <div class="text-sm font-bold text-gray-900 dark:text-white truncate transition-colors">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 truncate transition-colors">{{ Auth::user()->email }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content (Dark Canvas) -->
        <main class="flex-1 w-full relative overflow-y-auto mt-14 md:mt-0 transition-colors duration-300">
            <!-- Header section for desktop toggle if wanted -->
            <div class="hidden md:flex justify-end p-6 absolute top-0 right-0 z-20">
                <button @click="toggleTheme()" class="p-2.5 rounded-full bg-white/80 dark:bg-[#0a110d]/80 backdrop-blur-md text-gray-500 dark:text-gray-300 hover:bg-white dark:hover:bg-white/10 transition-colors border border-gray-200 dark:border-white/10 shadow-sm">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg x-show="darkMode" style="display: none;" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>
            </div>

            <div class="p-6 md:p-10 lg:p-12 h-full z-10 relative">
                {{ $slot }}
            </div>
        </main>

    </div>
</body>
</html>
