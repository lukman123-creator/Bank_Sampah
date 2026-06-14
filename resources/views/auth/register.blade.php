<x-guest-layout>
    <style>
        /* Override Chrome Autofill styling */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            -webkit-text-fill-color: #1f2937 !important;
            transition: background-color 5000s ease-in-out 0s;
        }
        .dark input:-webkit-autofill,
        .dark input:-webkit-autofill:hover, 
        .dark input:-webkit-autofill:focus, 
        .dark input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #0a110d inset !important;
            -webkit-text-fill-color: white !important;
        }
    </style>
    <div class="min-h-screen flex w-full bg-white dark:bg-[#0a110d] animate-fadeIn transition-colors duration-300">
        
        <!-- Theme Toggle Floating -->
        <div class="absolute top-8 right-8 z-50">
            <button @click="toggleTheme()" class="p-2.5 rounded-full bg-gray-100 dark:bg-white/5 text-gray-500 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-white/10 transition-colors border border-gray-200 dark:border-white/10 shadow-sm">
                <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                <svg x-show="darkMode" style="display: none;" class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </button>
        </div>
        <!-- Left Side: Foliage Image & Welcome Text -->
        <div class="hidden lg:flex w-1/2 relative bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?ixlib=rb-4.0.3&auto=format&fit=crop&w=1080&q=80');">
            <div class="absolute inset-0 bg-white/70 dark:bg-gradient-to-r dark:from-black/70 dark:via-[#0a110d]/50 dark:to-[#0a110d] transition-colors duration-300"></div>
            
            <div class="relative z-10 flex flex-col justify-center px-16 xl:px-24 w-full h-full">
                <a href="/" class="absolute top-10 left-16 flex items-center text-green-600 dark:text-green-400 font-bold text-2xl tracking-wider transition-colors">
                    ♻️ Bank Sampah
                </a>

                <div class="inline-block overflow-hidden whitespace-nowrap border-r-4 border-gray-900 dark:border-white animate-typing">
                    <h1 class="text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white leading-tight mb-2 tracking-tight transition-colors">
                        Join Our Movement
                    </h1>
                </div>
                <p class="text-gray-700 dark:text-gray-300 text-lg max-w-md font-medium dark:font-light leading-relaxed transition-colors">
                    Daftar sekarang untuk mulai mengumpulkan poin dari sampah daur ulang dan ikut serta menjaga kebersihan lingkungan kita bersama.
                </p>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-16 xl:p-24 bg-white dark:bg-[#0a110d] relative overflow-y-auto transition-colors duration-300">
            
            <!-- Mobile Logo -->
            <a href="/" class="lg:hidden absolute top-10 left-8 flex items-center text-green-600 dark:text-green-400 font-bold text-2xl tracking-wider transition-colors">
                ♻️ Bank Sampah
            </a>

            <div class="w-full max-w-md my-auto pt-16 lg:pt-0">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-10 transition-colors">Sign up</h2>

                <!-- Session Status & Errors -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('register') }}" class="space-y-8 animate-slideUp" style="animation-delay: 0.2s;">
                    @csrf

                    <!-- Name -->
                    <div class="relative">
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                            class="peer w-full bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white focus:border-green-600 dark:focus:border-green-500 focus:ring-0 px-0 py-2 placeholder-transparent transition-colors" placeholder="Name" />
                        <label for="name" class="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 dark:peer-placeholder-shown:text-gray-600 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-sm peer-focus:text-green-600 dark:peer-focus:text-green-500">
                            Your Name
                        </label>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 dark:text-red-400 text-xs" />
                    </div>

                    <!-- Email Address -->
                    <div class="relative">
                        <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" 
                            class="peer w-full bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white focus:border-green-600 dark:focus:border-green-500 focus:ring-0 px-0 py-2 placeholder-transparent transition-colors" placeholder="Email" />
                        <label for="email" class="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 dark:peer-placeholder-shown:text-gray-600 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-sm peer-focus:text-green-600 dark:peer-focus:text-green-500">
                            Your Email
                        </label>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 dark:text-red-400 text-xs" />
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <input id="password" type="password" name="password" required autocomplete="new-password" 
                            class="peer w-full bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white focus:border-green-600 dark:focus:border-green-500 focus:ring-0 px-0 py-2 placeholder-transparent transition-colors" placeholder="Password" />
                        <label for="password" class="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 dark:peer-placeholder-shown:text-gray-600 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-sm peer-focus:text-green-600 dark:peer-focus:text-green-500">
                            Create Password
                        </label>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 dark:text-red-400 text-xs" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="relative">
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                            class="peer w-full bg-transparent border-0 border-b-2 border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white focus:border-green-600 dark:focus:border-green-500 focus:ring-0 px-0 py-2 placeholder-transparent transition-colors" placeholder="Confirm Password" />
                        <label for="password_confirmation" class="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 dark:peer-placeholder-shown:text-gray-600 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-sm peer-focus:text-green-600 dark:peer-focus:text-green-500">
                            Repeat Password
                        </label>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 dark:text-red-400 text-xs" />
                    </div>

                    <div class="pt-6 flex items-center justify-between gap-6">
                        <button type="submit" class="w-full bg-[#108945] hover:bg-[#0c6b35] text-white font-bold py-3.5 px-4 rounded-lg shadow-[0_0_15px_rgba(16,137,69,0.3)] transition-all duration-300">
                            Sign up
                        </button>
                    </div>

                    <div class="mt-8 flex items-center justify-between">
                        <span class="text-sm text-gray-500">Already a Member? <a href="{{ route('login') }}" class="text-green-600 dark:text-green-500 hover:text-green-500 dark:hover:text-green-400 font-semibold ml-1">Sign in here</a></span>
                    </div>
                </form>
            </div>

            <!-- Vertical Social Login -->
            <div class="hidden sm:flex absolute right-8 top-1/2 transform -translate-y-1/2 flex-col gap-6 items-center">
                <div class="w-[1px] h-32 bg-gray-300 dark:bg-gray-700 transition-colors"></div>
                <span class="text-gray-400 dark:text-gray-600 text-xs font-bold tracking-widest uppercase rotate-90 my-6 transition-colors">OR</span>
                <div class="w-[1px] h-32 bg-gray-300 dark:bg-gray-700 transition-colors"></div>
                
                <a href="{{ route('login.google') }}" class="mt-8 bg-gray-100 hover:bg-gray-200 dark:bg-white/10 dark:hover:bg-white/20 p-3 rounded-full text-white transition-all backdrop-blur-sm group" title="Sign up with Google">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                </a>
            </div>
            
            <!-- Mobile Google Login -->
            <div class="sm:hidden w-full max-w-md mt-6 pb-8">
                <div class="flex items-center justify-center mb-6">
                    <span class="border-b border-gray-300 dark:border-gray-700 transition-colors flex-1 mr-3"></span>
                    <span class="text-sm text-gray-500 font-bold">OR</span>
                    <span class="border-b border-gray-300 dark:border-gray-700 transition-colors flex-1 ml-3"></span>
                </div>
                <a href="{{ route('login.google') }}" class="w-full flex items-center justify-center px-4 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-white/5 dark:hover:bg-white/10 border border-gray-300 dark:border-gray-700 rounded-lg text-gray-900 dark:text-white transition-colors">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    Continue with Google
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>
