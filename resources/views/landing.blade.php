<!DOCTYPE html>
<html lang="id" class="transition-colors duration-300">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah - Ubah Sampah Jadi Berkah</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 dark:text-gray-100 font-sans antialiased transition-colors duration-300 relative min-h-screen overflow-x-hidden">

    <!-- Background Gradient -->
    <div class="fixed inset-0 z-[-1] bg-gradient-to-br from-green-50 to-white dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-green-300 dark:bg-green-900 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-teal-300 dark:bg-teal-900 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-emerald-300 dark:bg-emerald-900 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <nav class="bg-white/40 dark:bg-gray-800/40 backdrop-blur-md border-b border-white/20 dark:border-gray-700/50 shadow-sm fixed w-full top-0 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center text-green-700 dark:text-green-400 font-bold text-2xl tracking-wide">
                    ♻️ Bank Sampah
                </div>

                <div class="hidden md:flex space-x-4 items-center">
                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 transition-colors">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </button>

                    <a href="{{ route('login') }}" class="text-green-800 dark:text-green-300 hover:text-green-600 dark:hover:text-green-100 font-medium transition">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-green-600 dark:bg-green-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 dark:hover:bg-green-600 transition shadow-md">Daftar</a>

                    <a href="{{ route('login.google') }}" class="flex items-center bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm text-gray-700 dark:text-gray-200 border border-white/40 dark:border-gray-600 px-4 py-2 rounded-lg font-medium hover:bg-white dark:hover:bg-gray-700 transition shadow-sm">
                        <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        Login Google
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="mt-24 mx-auto max-w-7xl px-4 sm:mt-28 sm:px-6 md:mt-32 lg:mt-40 lg:px-8">
        <div class="sm:text-center lg:text-left flex flex-col lg:flex-row items-center gap-10">
            <div class="lg:w-1/2 relative z-10">
                <div class="p-8 rounded-3xl bg-white/40 dark:bg-gray-800/40 backdrop-blur-lg border border-white/30 dark:border-gray-700/50 shadow-2xl">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                        <span class="block xl:inline">Kelola sampahmu,</span>
                        <span class="block text-green-600 dark:text-green-400 xl:inline mt-2">selamatkan bumi.</span>
                    </h1>
                    <p class="mt-4 text-base text-gray-600 dark:text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Bergabunglah dengan Bank Sampah kami. Kumpulkan sampah daur ulang, tukarkan menjadi saldo, dan pantau riwayat transaksimu dengan mudah melalui satu dashboard pintar.
                    </p>
                    <div class="mt-8 sm:flex sm:justify-center lg:justify-start gap-4">
                        <div class="rounded-xl shadow-lg hover:shadow-xl transition-shadow flex-1 min-w-[200px]">
                            <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg md:px-10 transition">
                                Mulai Sekarang
                            </a>
                        </div>
                        <div class="rounded-xl shadow-lg hover:shadow-xl transition-shadow flex-1 min-w-[200px]">
                            <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-green-800 dark:text-green-200 bg-green-100/80 dark:bg-green-900/40 hover:bg-green-200 dark:hover:bg-green-800/60 backdrop-blur-sm md:py-4 md:text-lg md:px-10 transition">
                                Masuk Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/2 mt-10 lg:mt-0 relative z-10">
                <div class="bg-white/40 dark:bg-gray-800/40 backdrop-blur-md border border-white/30 dark:border-gray-700/50 rounded-3xl h-64 sm:h-80 w-full flex items-center justify-center shadow-2xl relative overflow-hidden group">
                    <div class="absolute inset-0 bg-green-400/20 dark:bg-green-500/10 group-hover:bg-green-400/30 dark:group-hover:bg-green-500/20 transition-colors duration-500"></div>
                    <span class="text-green-800 dark:text-green-300 font-bold text-2xl relative z-20">♻️ Go Green & Clean!</span>
                </div>
            </div>
        </div>
    </main>

    <div class="mt-32 pb-16 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-8 bg-white/40 dark:bg-gray-800/40 backdrop-blur-md border border-white/20 dark:border-gray-700/50 rounded-2xl shadow-xl hover:-translate-y-2 transition-transform duration-300">
                    <div class="text-5xl mb-6">📱</div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Dashboard Interaktif</h3>
                    <p class="mt-3 text-gray-600 dark:text-gray-400">Pantau profil dan total saldo sampahmu dengan mudah dalam satu layar.</p>
                </div>
                <div class="p-8 bg-white/40 dark:bg-gray-800/40 backdrop-blur-md border border-white/20 dark:border-gray-700/50 rounded-2xl shadow-xl hover:-translate-y-2 transition-transform duration-300 delay-100">
                    <div class="text-5xl mb-6">💳</div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Riwayat Transaksi</h3>
                    <p class="mt-3 text-gray-600 dark:text-gray-400">Catatan lengkap transparan setiap kali kamu menyetor sampah.</p>
                </div>
                <div class="p-8 bg-white/40 dark:bg-gray-800/40 backdrop-blur-md border border-white/20 dark:border-gray-700/50 rounded-2xl shadow-xl hover:-translate-y-2 transition-transform duration-300 delay-200">
                    <div class="text-5xl mb-6">🔐</div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Akses Cepat & Aman</h3>
                    <p class="mt-3 text-gray-600 dark:text-gray-400">Daftar secara manual atau gunakan integrasi Akun Google agar lebih praktis.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
</body>
</html>
