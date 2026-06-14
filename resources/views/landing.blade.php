<!DOCTYPE html>
<html lang="id" class="transition-colors duration-300">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah - Ubah Sampah Jadi Berkah</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
    class="bg-white dark:bg-[#0a110d] text-gray-900 dark:text-gray-100 font-sans antialiased relative min-h-screen overflow-x-hidden selection:bg-green-500 selection:text-white transition-colors duration-300">

    <!-- Background Image & Gradient -->
    <div class="fixed inset-0 z-[-1] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <div class="absolute inset-0 bg-white/95 dark:bg-gradient-to-b dark:from-[#0a110d]/90 dark:via-[#0a110d]/70 dark:to-[#0a110d] backdrop-blur-[2px] transition-colors duration-300"></div>
    </div>

    <!-- Navbar -->
    <nav class="bg-white/60 dark:bg-[#0a110d]/60 backdrop-blur-md border-b border-gray-200 dark:border-white/5 shadow-sm fixed w-full top-0 z-50 animate-slideUp transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center text-green-600 dark:text-green-400 font-bold text-2xl tracking-wide transition-colors">
                    ♻️ Bank Sampah
                </div>

                <div class="flex items-center gap-4">
                    <!-- Theme Toggle -->
                    <button @click="toggleTheme()" class="p-2.5 rounded-full bg-gray-100 dark:bg-white/5 text-gray-500 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-white/10 transition-colors border border-gray-200 dark:border-white/10 shadow-sm mr-2">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <svg x-show="darkMode" style="display: none;" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>

                    <div class="hidden md:flex space-x-4 lg:space-x-6 items-center">
                        <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-medium transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-[#108945] text-white px-5 py-2.5 rounded-lg font-bold hover:bg-[#0c6b35] transition shadow-lg hover:shadow-green-900/50">Daftar</a>

                        <a href="{{ route('login.google') }}" class="flex items-center bg-gray-100 dark:bg-white/10 backdrop-blur-sm text-gray-800 dark:text-white border border-gray-300 dark:border-white/20 px-5 py-2.5 rounded-lg font-medium hover:bg-gray-200 dark:hover:bg-white/20 transition-colors shadow-sm group">
                            <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            Google
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="mt-28 mx-auto max-w-7xl px-4 sm:mt-36 sm:px-6 md:mt-40 lg:px-8">
        <div class="sm:text-center lg:text-left flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2 relative z-10">
                <div class="p-8 md:p-10 rounded-[2.5rem] bg-white/80 dark:bg-[#0a110d]/40 backdrop-blur-xl border border-gray-200 dark:border-white/10 shadow-2xl animate-fadeIn transition-colors duration-300">
                    
                    <!-- Typing Animation for Main Title -->
                    <div class="mb-4 flex items-center h-12 sm:h-16 md:h-20" x-data="{ text: '', fullText: 'Kelola sampahmu,' }" x-init="let i = 0; setTimeout(() => { let int = setInterval(() => { text += fullText[i]; i++; if(i === fullText.length) clearInterval(int); }, 100) }, 500)">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl transition-colors">
                            <span x-text="text"></span><span class="border-r-4 border-green-600 dark:border-green-500 animate-blink h-full inline-block ml-1 align-bottom text-transparent">_</span>
                        </h1>
                    </div>
                    <h1 class="text-4xl tracking-tight font-extrabold text-green-600 dark:text-green-400 sm:text-5xl md:text-6xl animate-slideUp transition-colors" style="animation-delay: 2s;">
                        selamatkan bumi.
                    </h1>

                    <p class="mt-6 text-base text-gray-600 dark:text-gray-300 sm:text-lg sm:max-w-xl sm:mx-auto md:text-xl lg:mx-0 font-medium dark:font-light leading-relaxed animate-slideUp transition-colors" style="animation-delay: 2.2s;">
                        Bergabunglah dengan Bank Sampah kami. Kumpulkan sampah daur ulang, tukarkan menjadi saldo, dan pantau riwayat transaksimu dengan mudah melalui satu dashboard pintar bergaya elegan.
                    </p>
                    
                    <div class="mt-10 sm:flex sm:justify-center lg:justify-start gap-5 animate-slideUp" style="animation-delay: 2.4s;">
                        <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-2xl text-white bg-[#108945] hover:bg-[#0c6b35] md:text-lg md:px-10 transition-all shadow-[0_0_20px_rgba(16,137,69,0.4)] hover:shadow-[0_0_30px_rgba(16,137,69,0.6)]">
                            Mulai Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-4 border border-gray-300 dark:border-white/20 text-base font-bold rounded-2xl text-gray-800 dark:text-white bg-gray-50 dark:bg-white/5 hover:bg-gray-100 dark:hover:bg-white/10 backdrop-blur-sm md:text-lg md:px-10 transition-colors mt-4 sm:mt-0">
                            Masuk Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Visual -->
            <div class="lg:w-1/2 mt-10 lg:mt-0 relative z-10 animate-slideUp" style="animation-delay: 2.6s;">
                <div class="bg-white/80 dark:bg-[#0a110d]/40 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2.5rem] h-64 sm:h-80 w-full flex flex-col items-center justify-center shadow-2xl relative overflow-hidden group transition-colors duration-300">
                    <div class="absolute inset-0 bg-green-50 dark:bg-green-500/5 group-hover:bg-green-100 dark:group-hover:bg-green-500/10 transition-colors duration-500"></div>
                    <div class="w-20 h-20 bg-green-100 dark:bg-[#108945]/20 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-all duration-500">
                        <span class="text-4xl">♻️</span>
                    </div>
                    <span class="text-green-700 dark:text-green-400 font-bold text-2xl relative z-20 tracking-wide transition-colors">Go Green & Clean!</span>
                </div>
            </div>
        </div>
    </main>

    <!-- Features -->
    <div class="mt-32 pb-24 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <!-- Card 1 -->
                <div class="p-8 bg-white/80 dark:bg-[#0a110d]/40 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-3xl shadow-xl hover:-translate-y-2 transition-all duration-300 animate-slideUp" style="animation-delay: 2.8s;">
                    <div class="w-16 h-16 mx-auto bg-gray-50 dark:bg-white/5 rounded-2xl flex items-center justify-center text-3xl mb-6 border border-gray-200 dark:border-white/10 transition-colors">📱</div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 transition-colors">Dashboard Interaktif</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-medium dark:font-light leading-relaxed transition-colors">Pantau profil dan total saldo sampahmu dengan mudah dalam satu layar bertema elegan.</p>
                </div>
                <!-- Card 2 -->
                <div class="p-8 bg-white/80 dark:bg-[#0a110d]/40 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-3xl shadow-xl hover:-translate-y-2 transition-all duration-300 animate-slideUp" style="animation-delay: 3.0s;">
                    <div class="w-16 h-16 mx-auto bg-gray-50 dark:bg-white/5 rounded-2xl flex items-center justify-center text-3xl mb-6 border border-gray-200 dark:border-white/10 transition-colors">💳</div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 transition-colors">Riwayat Transaksi</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-medium dark:font-light leading-relaxed transition-colors">Catatan lengkap transparan setiap kali kamu menyetor sampah, langsung terkonversi jadi saldo.</p>
                </div>
                <!-- Card 3 -->
                <div class="p-8 bg-white/80 dark:bg-[#0a110d]/40 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-3xl shadow-xl hover:-translate-y-2 transition-all duration-300 animate-slideUp" style="animation-delay: 3.2s;">
                    <div class="w-16 h-16 mx-auto bg-gray-50 dark:bg-white/5 rounded-2xl flex items-center justify-center text-3xl mb-6 border border-gray-200 dark:border-white/10 transition-colors">🔐</div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 transition-colors">Akses Cepat & Aman</h3>
                    <p class="text-gray-600 dark:text-gray-400 font-medium dark:font-light leading-relaxed transition-colors">Daftar secara manual atau gunakan integrasi Akun Google agar lebih praktis masuk ke sistem.</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
