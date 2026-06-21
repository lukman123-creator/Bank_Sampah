<!DOCTYPE html>
<html lang="id" class="transition-colors duration-300">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah</title>
    <link rel="icon" href="{{ asset('images/logo1.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else { document.documentElement.classList.remove('dark') }
    </script>
</head>
<body x-data="{

        darkMode: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),

        toggleTheme() {

            this.darkMode = !this.darkMode;

            if (this.darkMode) { document.documentElement.classList.add('dark'); localStorage.theme = 'dark'; }

            else { document.documentElement.classList.remove('dark'); localStorage.theme = 'light'; }

        }

    }"

    class="bg-white dark:bg-[#0a110d] text-gray-900 dark:text-gray-100 font-sans antialiased relative min-h-screen overflow-x-hidden selection:bg-green-500 selection:text-white transition-colors duration-300">



    <div class="fixed inset-0 z-[-1] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">

        <div class="absolute inset-0 bg-white/95 dark:bg-gradient-to-b dark:from-[#0a110d]/90 dark:via-[#0a110d]/70 dark:to-[#0a110d] backdrop-blur-[2px]"></div>

    </div>



    <nav class="bg-white/60 dark:bg-[#0a110d]/60 backdrop-blur-md border-b border-gray-200 dark:border-white/5 shadow-sm fixed w-full top-0 z-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between h-20 items-center">

                <div class="flex-shrink-0 flex items-center text-green-600 dark:text-green-400 font-bold text-2xl tracking-wide">

                    ♻️ Bank Sampah

                </div>

                <div class="flex items-center gap-4">

                    <button @click="toggleTheme()" class="p-2.5 rounded-full bg-gray-100 dark:bg-white/5 text-gray-500 dark:text-gray-300 hover:bg-gray-200 hover:bg-white/10">

                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>

                        <svg x-show="darkMode" style="display: none;" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>

                    </button>

                    <div class="hidden md:flex space-x-4 lg:space-x-6 items-center">

                        <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 font-medium">Masuk</a>

                        <a href="{{ route('register') }}" class="bg-[#108945] text-white px-5 py-2.5 rounded-lg font-bold hover:bg-[#0c6b35] shadow-lg">Daftar</a>

                    </div>

                </div>

            </div>

        </div>

    </nav>



    <main class="mt-28 mb-48 mx-auto max-w-7xl px-4 sm:mt-36 sm:px-6 md:mt-40 lg:px-8">

        <div class="sm:text-center lg:text-left flex flex-col lg:flex-row items-center gap-12 mb-96">

            <div class="lg:w-1/2 relative z-10">

                <div class="p-8 md:p-10 rounded-[2.5rem] bg-white/80 dark:bg-[#0a110d]/40 backdrop-blur-xl border border-gray-200 dark:border-white/10 shadow-2xl">

                    <div class="mb-4 flex items-center h-12 sm:h-16 md:h-20" x-data="{ text: '', fullText: 'Kelola sampahmu,' }" x-init="let i = 0; setTimeout(() => { let int = setInterval(() => { text += fullText[i]; i++; if(i === fullText.length) clearInterval(int); }, 100) }, 500)">

                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl">

                            <span x-text="text"></span><span class="border-r-4 border-green-600 animate-blink h-full inline-block ml-1 align-bottom text-transparent">_</span>

                        </h1>

                    </div>

                    <h1 class="text-4xl tracking-tight font-extrabold text-green-600 dark:text-green-400 sm:text-5xl md:text-6xl animate-slideUp" style="animation-delay: 2s;">selamatkan bumi.</h1>

                    <p class="mt-6 text-base text-gray-600 dark:text-gray-300 sm:text-lg sm:max-w-xl sm:mx-auto md:text-xl lg:mx-0 font-medium dark:font-light leading-relaxed animate-slideUp" style="animation-delay: 2.2s;">Bergabunglah dengan Bank Sampah kami. Kumpulkan sampah daur ulang, tukarkan menjadi saldo, dan pantau riwayat transaksimu dengan mudah melalui satu dashboard pintar bergaya elegan.</p>

                    <div class="mt-10 sm:flex sm:justify-center lg:justify-start gap-5 animate-slideUp" style="animation-delay: 2.4s;">

                        <a href="{{ route('register') }}" class="w-full flex justify-center px-8 py-4 text-base font-bold rounded-2xl text-white bg-[#108945] shadow-[0_0_20px_rgba(16,137,69,0.4)]">Mulai Sekarang</a>

                        <a href="{{ route('login') }}" class="w-full flex justify-center px-8 py-4 border border-gray-300 dark:border-white/20 font-bold rounded-2xl text-gray-800 dark:text-white bg-gray-50 dark:bg-white/5 backdrop-blur-sm mt-4 sm:mt-0">Masuk Dashboard</a>

                    </div>

                </div>

            </div>

            <div class="lg:w-1/2 mt-10 lg:mt-0 relative z-10 animate-slideUp" style="animation-delay: 2.6s;">

                <div class="bg-white/80 dark:bg-[#0a110d]/40 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2.5rem] h-64 sm:h-80 w-full flex flex-col items-center justify-center shadow-2xl relative overflow-hidden group">

                    <div class="absolute inset-0 bg-green-50 dark:bg-green-500/5 group-hover:bg-green-100 dark:group-hover:bg-green-500/10 transition-colors duration-500"></div>

                    <div class="w-20 h-20 bg-green-100 dark:bg-[#108945]/20 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-all duration-500"><span class="text-4xl">♻️</span></div>

                    <span class="text-green-700 dark:text-green-400 font-bold text-2xl relative z-20 tracking-wide">Go Green & Clean!</span>

                </div>

            </div>

        </div>

    </main>
    <div class="h-24"></div>
    <section class="mt-12 py-24 bg-gray-50 dark:bg-[#0e1611] border-y border-gray-200 dark:border-gray-800 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 py-6 px-4 md:px-6">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">Lebih dari sekadar membuang, <span class="text-green-600 dark:text-green-400">kami mengelola.</span></h3>
            </div>
            <div class="h-8"></div>
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                <div class="w-full lg:w-1/2">
                    <img src="https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Tim Pengelola Sampah" class="w-full rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 object-cover aspect-video lg:aspect-[4/3]">
                </div>
                
                <div class="w-full lg:w-1/2 space-y-8">
                    <div>
                        <h4 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Visi Kami: Lingkungan Bersih, Ekonomi Maju</h4>
                        <p class="text-gray-600 dark:text-gray-300 text-base leading-relaxed">
                            Bank Sampah didirikan untuk memberikan solusi inovatif terhadap permasalahan sampah di lingkungan sekitar. Kami percaya bahwa setiap material yang dibuang masih memiliki nilai ekonomi jika dikelola dengan benar.
                        </p>
                    </div>
                    
                    <div class="space-y-6 pt-2">
                        <div class="flex items-start gap-4">
                            <div class="shrink-0 mt-1">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <div>
                                <h5 class="text-lg font-bold text-gray-900 dark:text-white">Edukasi Rumah Tangga</h5>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Membimbing masyarakat untuk memilah sampah sejak dari sumbernya.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="shrink-0 mt-1">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h5 class="text-lg font-bold text-gray-900 dark:text-white">Konversi Ekonomi</h5>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Mengubah sampah anorganik menjadi aset digital atau uang tunai.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="shrink-0 mt-1">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                            </div>
                            <div>
                                <h5 class="text-lg font-bold text-gray-900 dark:text-white">Penyaluran Transparan</h5>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Distribusi langsung ke pabrik daur ulang besar tanpa perantara.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="h-24"></div>
    <section class="mt-12 py-24 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 py-6 px-4 md:px-6">
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">Estimasi Harga per Kilogram</h3>
                <p class="text-lg text-gray-600 dark:text-gray-400">
                    Kumpulkan dan pisahkan sampahmu berdasarkan jenis di bawah ini untuk mendapatkan nilai tukar maksimal.
                </p>
            </div>
            <div class="h-16"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 lg:divide-x divide-gray-200 dark:divide-gray-800 border-y border-gray-200 dark:border-gray-800 py-10">
                
                <div class="flex flex-col items-center text-center p-6 lg:px-6">
                    <div class="mb-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/3003/3003984.png" alt="Plastik" class="w-16 h-16 opacity-80 dark:invert">
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Plastik Botol</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6 flex-grow">Botol bening (PET) atau plastik kemasan. Pastikan dalam keadaan kering.</p>
                    <div class="mt-auto">
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">Rp 2.500 <span class="text-sm text-gray-500 font-normal">/ kg</span></p>
                    </div>
                </div>
                
                <div class="flex flex-col items-center text-center p-6 lg:px-6">
                    <div class="mb-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/2682/2682065.png" alt="Kardus" class="w-16 h-16 opacity-80 dark:invert">
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Kardus</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6 flex-grow">Karton, duplek, atau kertas bekas. Lipat rapi untuk memudahkan timbangan.</p>
                    <div class="mt-auto">
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">Rp 1.500 <span class="text-sm text-gray-500 font-normal">/ kg</span></p>
                    </div>
                </div>
                
                <div class="flex flex-col items-center text-center p-6 lg:px-6">
                    <div class="mb-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/3004/3004003.png" alt="Besi" class="w-16 h-16 opacity-80 dark:invert">
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Besi & Kaleng</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6 flex-grow">Seng, aluminium, atau kaleng bekas minuman yang sudah dicuci bersih.</p>
                    <div class="mt-auto">
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">Rp 3.000 <span class="text-sm text-gray-500 font-normal">/ kg</span></p>
                    </div>
                </div>
                
                <div class="flex flex-col items-center text-center p-6 lg:px-6">
                    <div class="mb-5">
                        <img src="{{ asset('images/bottle.png') }}" alt="Kaca" class="w-16 h-16 opacity-80 dark:invert">
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Botol Kaca</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6 flex-grow">Beling utuh maupun pecahan kaca. Harap dikemas dengan aman.</p>
                    <div class="mt-auto">
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">Rp 800 <span class="text-sm text-gray-500 font-normal">/ kg</span></p>
                    </div>
                </div>

            </div>
            <div class="h-16"></div>
            <div class="mt-12 text-center">
                <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Harga dapat berubah sewaktu-waktu mengikuti standar pabrik daur ulang.
                </p>
            </div>
        </div>
        <div class="h-24"></div>
    </section>

</body>
</html>