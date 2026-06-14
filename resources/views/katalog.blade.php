<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 text-green-700 dark:text-green-400 px-6 py-4 rounded-2xl mb-8 shadow-[0_0_15px_rgba(34,197,94,0.1)] flex items-center gap-3 animate-slideUp transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-600 dark:text-red-400 px-6 py-4 rounded-2xl mb-8 shadow-[0_0_15px_rgba(239,68,68,0.1)] flex items-center gap-3 animate-slideUp transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Header Section -->
            <div class="mb-10 animate-slideUp" style="animation-delay: 0.1s;">
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-2 transition-colors">Katalog <span class="text-green-600 dark:text-green-500">Hadiah</span></h2>
                <p class="text-gray-600 dark:text-gray-400 font-medium text-lg transition-colors">Tukarkan saldo dompetmu dengan berbagai hadiah menarik.</p>
            </div>

            <!-- Saldo Card -->
            <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 overflow-hidden shadow-2xl rounded-[2.5rem] mb-10 p-8 lg:p-10 relative group hover:-translate-y-1 transition-all duration-300 animate-slideUp" style="animation-delay: 0.2s;">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-green-500/5 dark:bg-green-500/10 rounded-full mix-blend-overlay filter blur-3xl opacity-50 group-hover:scale-110 transition-transform duration-700"></div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm uppercase font-bold tracking-wider mb-2 relative z-10 transition-colors">Saldo Tersedia Kamu</h3>
                <p class="text-5xl font-black text-gray-900 dark:text-white relative z-10 transition-colors"><span class="text-2xl text-gray-400 dark:text-gray-500 mr-2">Rp</span>{{ number_format($saldo, 0, ',', '.') }}</p>
            </div>

            <!-- Katalog Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Hadiah 1 -->
                <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 p-8 rounded-[2rem] shadow-xl hover:-translate-y-2 transition-all duration-300 animate-slideUp group" style="animation-delay: 0.3s;">
                    <div class="w-16 h-16 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl flex items-center justify-center mb-6 text-3xl group-hover:scale-110 transition-all">📱</div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2 transition-colors">Pulsa 10rb</h4>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 font-medium transition-colors">Harga: <span class="text-green-600 dark:text-green-400 font-bold transition-colors">Rp 11.000</span></p>
                    <form action="{{ route('katalog.tukar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama_hadiah" value="Pulsa 10rb">
                        <input type="hidden" name="harga" value="11000">
                        <button type="submit" class="w-full bg-[#108945] hover:bg-[#0c6b35] text-white font-bold py-3 px-4 rounded-xl shadow-[0_0_15px_rgba(16,137,69,0.3)] transition-all border border-transparent">
                            Tukar Sekarang
                        </button>
                    </form>
                </div>

                <!-- Hadiah 2 -->
                <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 p-8 rounded-[2rem] shadow-xl hover:-translate-y-2 transition-all duration-300 animate-slideUp group" style="animation-delay: 0.4s;">
                    <div class="w-16 h-16 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl flex items-center justify-center mb-6 text-3xl group-hover:scale-110 transition-all">⚡</div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2 transition-colors">Token Listrik 20rb</h4>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 font-medium transition-colors">Harga: <span class="text-green-600 dark:text-green-400 font-bold transition-colors">Rp 22.000</span></p>
                    <form action="{{ route('katalog.tukar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama_hadiah" value="Token Listrik 20rb">
                        <input type="hidden" name="harga" value="22000">
                        <button type="submit" class="w-full bg-[#108945] hover:bg-[#0c6b35] text-white font-bold py-3 px-4 rounded-xl shadow-[0_0_15px_rgba(16,137,69,0.3)] transition-all border border-transparent">
                            Tukar Sekarang
                        </button>
                    </form>
                </div>

                <!-- Hadiah 3 -->
                <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 p-8 rounded-[2rem] shadow-xl hover:-translate-y-2 transition-all duration-300 animate-slideUp group" style="animation-delay: 0.5s;">
                    <div class="w-16 h-16 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl flex items-center justify-center mb-6 text-3xl group-hover:scale-110 transition-all">🛍️</div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2 transition-colors">Paket Sembako</h4>
                    <p class="text-gray-600 dark:text-gray-400 mb-6 font-medium transition-colors">Harga: <span class="text-green-600 dark:text-green-400 font-bold transition-colors">Rp 90.000</span></p>
                    <form action="{{ route('katalog.tukar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama_hadiah" value="Paket Sembako">
                        <input type="hidden" name="harga" value="90000">
                        <button type="submit" class="w-full bg-[#108945] hover:bg-[#0c6b35] text-white font-bold py-3 px-4 rounded-xl shadow-[0_0_15px_rgba(16,137,69,0.3)] transition-all border border-transparent">
                            Tukar Sekarang
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
