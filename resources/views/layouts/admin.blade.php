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
</head>
<body class="font-sans antialiased bg-[#0a110d] text-gray-100 flex min-h-screen selection:bg-green-500 selection:text-white">

    <!-- Background Image & Gradient -->
    <div class="fixed inset-0 z-[-1] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <div class="absolute inset-0 bg-gradient-to-b from-[#0a110d]/90 via-[#0a110d]/70 to-[#0a110d] backdrop-blur-[2px]"></div>
    </div>

    <!-- Mobile Sidebar Overlay & Toggle (Alpine.js) -->
    <div x-data="{ sidebarOpen: false }" class="flex w-full min-h-screen">
        
        <!-- Mobile Header -->
        <div class="md:hidden flex items-center justify-between p-4 bg-[#0a110d]/80 backdrop-blur-md text-white w-full absolute top-0 z-20 border-b border-white/5 animate-fadeIn">
            <div class="font-bold text-xl flex items-center gap-2">
                ♻️ AdminPanel
            </div>
            <button @click="sidebarOpen = !sidebarOpen" class="p-2 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>

        <!-- Sidebar -->
        <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" class="absolute md:relative z-10 w-64 min-h-screen bg-[#0a110d]/80 backdrop-blur-xl text-white flex flex-col transition-transform duration-300 md:translate-x-0 pt-16 md:pt-0 border-r border-white/10 animate-slideUp">
            
            <div class="p-8 hidden md:flex items-center gap-3">
                <span class="text-3xl text-green-500">♻️</span>
                <span class="font-bold text-xl tracking-wide">AeuxAdmin</span>
            </div>

            <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                Navigation
            </div>

            <nav class="flex-1 px-4 space-y-2">
                <!-- Active Link -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-[#108945]/20 text-green-400 rounded-2xl font-medium shadow-sm border border-green-500/30">
                    <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                <!-- Inactive Link -->
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-400 hover:bg-white/5 hover:text-white rounded-2xl font-medium transition-colors">
                    <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Analytics
                </a>
            </nav>

            <div class="p-6 mt-auto">
                <div class="bg-white/5 rounded-2xl p-4 flex items-center gap-3 border border-white/10">
                    <div class="w-10 h-10 rounded-full bg-[#108945] flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 overflow-hidden">
                        <div class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-white" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content (Dark Canvas) -->
        <main class="flex-1 w-full relative overflow-y-auto mt-14 md:mt-0">
            <div class="p-6 md:p-10 lg:p-12 h-full z-10 relative">
                {{ $slot }}
            </div>
        </main>

    </div>
</body>
</html>
