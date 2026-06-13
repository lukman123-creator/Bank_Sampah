<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah - Ubah Sampah Jadi Berkah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <nav class="bg-green-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center text-white font-bold text-2xl tracking-wide">
                    ♻️ Bank Sampah
                </div>

                <div class="hidden md:flex space-x-4 items-center">
                    <a href="{{ route('login') }}" class="text-white hover:text-green-200 font-medium transition">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-green-800 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700 transition">Daftar</a>

                    <a href="{{ route('login.google') }}" class="flex items-center bg-white text-gray-700 border border-gray-300 px-4 py-2 rounded-md font-medium hover:bg-gray-100 transition shadow-sm">
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

    <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
        <div class="sm:text-center lg:text-left flex flex-col lg:flex-row items-center gap-10">
            <div class="lg:w-1/2">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block xl:inline">Kelola sampahmu,</span>
                    <span class="block text-green-600 xl:inline">selamatkan bumi.</span>
                </h1>
                <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                    Bergabunglah dengan Bank Sampah kami. Kumpulkan sampah daur ulang, tukarkan menjadi saldo, dan pantau riwayat transaksimu dengan mudah melalui satu dashboard pintar.
                </p>
                <div class="mt-5 sm:mt-8 sm:flex sm:flex-wrap sm:justify-center lg:justify-start gap-3">
                    <div class="rounded-md shadow flex-1 min-w-[200px]">
                        <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg md:px-10 transition">
                            Mulai Sekarang
                        </a>
                    </div>
                    <div class="rounded-md shadow flex-1 min-w-[200px]">
                        <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 md:py-4 md:text-lg md:px-10 transition">
                            Masuk Dashboard
                        </a>
                    </div>
                    <div class="rounded-md shadow flex-1 min-w-[200px]">
                        <a href="{{ route('login.google') }}" class="w-full flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100 md:py-4 md:text-lg md:px-10 transition">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            Login dengan Google
                        </a>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/2 mt-10 lg:mt-0">
                <div class="bg-green-200 rounded-xl h-64 sm:h-80 w-full flex items-center justify-center shadow-inner">
                    <span class="text-green-700 font-semibold text-xl">Ilustrasi Daur Ulang & Lingkungan</span>
                </div>
            </div>
        </div>
    </main>

    <div class="bg-white mt-24 py-12 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6">
                    <div class="text-4xl mb-4">📱</div>
                    <h3 class="text-lg font-bold text-gray-900">Dashboard Interaktif</h3>
                    <p class="mt-2 text-gray-500">Pantau profil dan total saldo sampahmu dengan mudah.</p>
                </div>
                <div class="p-6">
                    <div class="text-4xl mb-4">💳</div>
                    <h3 class="text-lg font-bold text-gray-900">Riwayat Transaksi</h3>
                    <p class="mt-2 text-gray-500">Catatan lengkap setiap kali kamu menyetor sampah.</p>
                </div>
                <div class="p-6">
                    <div class="text-4xl mb-4">🔐</div>
                    <h3 class="text-lg font-bold text-gray-900">Akses Cepat & Aman</h3>
                    <p class="mt-2 text-gray-500">Daftar secara manual atau gunakan integrasi Akun Google.</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
