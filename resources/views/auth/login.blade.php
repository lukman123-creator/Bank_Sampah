<x-guest-layout>
    <div class="min-h-screen flex w-full bg-[#0a110d]">
        <!-- Left Side: Foliage Image & Welcome Text -->
        <div class="hidden lg:flex w-1/2 relative bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1511497584788-876760111969?ixlib=rb-4.0.3&auto=format&fit=crop&w=1080&q=80');">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-[#0a110d]/50 to-[#0a110d]"></div>
            
            <div class="relative z-10 flex flex-col justify-center px-16 xl:px-24 w-full h-full">
                <a href="/" class="absolute top-10 left-16 flex items-center text-green-400 font-bold text-2xl tracking-wider">
                    ♻️ Bank Sampah
                </a>

                <h1 class="text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 tracking-tight">
                    Welcome <br> Back
                </h1>
                <p class="text-gray-300 text-lg max-w-md font-light leading-relaxed">
                    Masuk ke akunmu untuk mulai mengelola setoran sampah, memantau saldo, dan berkontribusi menyelamatkan bumi hari ini.
                </p>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-16 xl:p-24 bg-[#0a110d] relative">
            
            <!-- Mobile Logo -->
            <a href="/" class="lg:hidden absolute top-10 left-8 flex items-center text-green-400 font-bold text-2xl tracking-wider">
                ♻️ Bank Sampah
            </a>

            <div class="w-full max-w-md">
                <h2 class="text-3xl font-bold text-white mb-10">Sign in</h2>

                <!-- Session Status & Errors -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                @if (session('error'))
                    <div class="mb-6 p-4 rounded-lg bg-red-900/50 border border-red-500/50 text-red-200 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-8">
                    @csrf

                    <!-- Email Address -->
                    <div class="relative">
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                            class="peer w-full bg-transparent border-0 border-b-2 border-gray-700 text-white focus:border-green-500 focus:ring-0 px-0 py-2 placeholder-transparent transition-colors" placeholder="Email" />
                        <label for="email" class="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-600 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-sm peer-focus:text-green-500">
                            Your Email
                        </label>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs" />
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                            class="peer w-full bg-transparent border-0 border-b-2 border-gray-700 text-white focus:border-green-500 focus:ring-0 px-0 py-2 placeholder-transparent transition-colors" placeholder="Password" />
                        <label for="password" class="absolute left-0 -top-3.5 text-gray-500 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-600 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-sm peer-focus:text-green-500">
                            Enter Password
                        </label>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between pt-2">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-700 bg-gray-900 text-green-500 shadow-sm focus:ring-green-500 focus:ring-offset-gray-900" name="remember">
                            <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-500 hover:text-green-400 transition-colors" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="pt-4 flex items-center justify-between gap-6">
                        <button type="submit" class="w-full bg-[#108945] hover:bg-[#0c6b35] text-white font-bold py-3.5 px-4 rounded-lg shadow-lg hover:shadow-green-900/50 transition-all duration-300">
                            Sign in
                        </button>
                    </div>

                    <div class="mt-8 flex items-center justify-between">
                        <span class="text-sm text-gray-500">Not a Member? <a href="{{ route('register') }}" class="text-green-500 hover:text-green-400 font-semibold ml-1">Sign up here</a></span>
                    </div>
                </form>
            </div>

            <!-- Vertical Social Login (Like in Reference) -->
            <div class="hidden sm:flex absolute right-8 top-1/2 transform -translate-y-1/2 flex-col gap-6 items-center">
                <div class="w-[1px] h-32 bg-gray-700"></div>
                <span class="text-gray-600 text-xs font-bold tracking-widest uppercase rotate-90 my-6">OR</span>
                <div class="w-[1px] h-32 bg-gray-700"></div>
                
                <a href="{{ route('login.google') }}" class="mt-8 bg-white/10 hover:bg-white/20 p-3 rounded-full text-white transition-all backdrop-blur-sm group" title="Login with Google">
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
                    <span class="border-b border-gray-700 flex-1 mr-3"></span>
                    <span class="text-sm text-gray-600 font-bold">OR</span>
                    <span class="border-b border-gray-700 flex-1 ml-3"></span>
                </div>
                <a href="{{ route('login.google') }}" class="w-full flex items-center justify-center px-4 py-3 bg-white/5 border border-gray-700 rounded-lg text-white hover:bg-white/10 transition">
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
