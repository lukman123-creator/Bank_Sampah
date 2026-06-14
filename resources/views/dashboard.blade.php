<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Hero Section / Welcome Banner -->
            <div class="relative bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl mb-10 text-gray-900 dark:text-white animate-fadeIn transition-colors duration-300">
                <div class="absolute inset-0 opacity-20" style="background-image: url('https://images.unsplash.com/photo-1550989460-0adf9ea622e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1080&q=80'); background-size: cover; background-position: center;"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-white dark:from-[#0a110d] via-white/80 dark:via-[#0a110d]/80 to-transparent transition-colors duration-300"></div>
                
                <div class="relative z-10 p-10 md:p-16 flex flex-col justify-center min-h-[300px]">
                    <span class="inline-block px-5 py-2 bg-green-50 dark:bg-white/5 border border-green-200 dark:border-white/10 backdrop-blur-sm rounded-full text-sm font-semibold tracking-wide mb-6 w-fit text-green-700 dark:text-green-400 transition-colors">Welcome Back, {{ Auth::user()->name }}</span>
                    
                    <div class="inline-block overflow-hidden whitespace-nowrap border-r-4 border-green-600 dark:border-green-500 animate-typing mb-4 w-fit">
                        <h2 class="text-4xl md:text-5xl font-extrabold leading-tight tracking-tight py-2 transition-colors">
                            Growing <span class="text-green-600 dark:text-green-500">Green</span>
                        </h2>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4 tracking-tight animate-slideUp transition-colors" style="animation-delay: 2s;">
                        Together
                    </h2>

                    <p class="text-gray-600 dark:text-gray-300 max-w-lg text-lg font-medium dark:font-light leading-relaxed animate-slideUp transition-colors" style="animation-delay: 2.2s;">
                        Di Bank Sampah, mendaur ulang adalah gaya hidup. Mulai pilah sampahmu hari ini, kumpulkan poin, dan bantu kami menumbuhkan masa depan yang lebih hijau.
                    </p>
                </div>
            </div>

            <!-- Stats Section (Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Card 1 -->
                <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2rem] p-8 shadow-xl flex items-center justify-between group hover:-translate-y-2 transition-all duration-300 animate-slideUp" style="animation-delay: 2.4s;">
                    <div>
                        <h4 class="text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider text-sm mb-2 transition-colors">Total Sampah Disetor</h4>
                        <p class="text-5xl font-black text-gray-900 dark:text-white transition-colors" x-data="numberCounter({{ $total_berat ?? 0 }})"><span x-text="formatted()"></span><span class="text-2xl font-bold text-gray-400 dark:text-gray-500 ml-2">Kg</span></p>
                        <p class="text-sm font-semibold text-green-600 dark:text-green-500 mt-4 flex items-center gap-2 transition-colors">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            Berkontribusi aktif
                        </p>
                    </div>
                    <div class="w-32 h-32 rounded-[1.5rem] overflow-hidden shadow-lg border border-gray-200 dark:border-white/10 group-hover:scale-105 transition-all duration-500 relative">
                        <div class="absolute inset-0 bg-green-500/10 dark:bg-green-500/20 mix-blend-overlay z-10 transition-colors"></div>
                        <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Recycling" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2rem] p-8 shadow-xl flex items-center justify-between group hover:-translate-y-2 transition-all duration-300 animate-slideUp" style="animation-delay: 2.6s;">
                    <div>
                        <h4 class="text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider text-sm mb-2 transition-colors">Saldo Dompet</h4>
                        <p class="text-5xl font-black text-gray-900 dark:text-white transition-colors" x-data="numberCounter({{ $total_saldo ?? 0 }}, true)"><span class="text-2xl font-bold text-gray-400 dark:text-gray-500 mr-2">Rp</span><span x-text="formatted()"></span></p>
                        <p class="text-sm font-semibold text-green-600 dark:text-green-500 mt-4 flex items-center gap-2 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Tarik tunai kapan saja
                        </p>
                    </div>
                    <div class="w-32 h-32 rounded-[1.5rem] overflow-hidden shadow-lg bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 flex items-center justify-center group-hover:scale-105 transition-all duration-500">
                        <svg class="w-16 h-16 text-green-600 dark:text-green-500 drop-shadow-[0_0_15px_rgba(34,197,94,0.3)] dark:drop-shadow-[0_0_15px_rgba(34,197,94,0.5)] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2.5rem] p-8 shadow-xl animate-slideUp transition-colors duration-300" style="animation-delay: 2.8s;">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white transition-colors">Riwayat Setoran <span class="text-green-600 dark:text-green-500">Terakhir</span></h3>
                    <a href="{{ route('transactions.index') }}" class="text-sm font-bold text-gray-500 dark:text-gray-400 hover:text-green-600 dark:hover:text-green-400 flex items-center gap-1 transition-colors">
                        View All <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-white/10 transition-colors">
                                <th class="pb-4 font-bold text-gray-400 dark:text-gray-500 text-sm tracking-wider uppercase transition-colors">Tanggal</th>
                                <th class="pb-4 font-bold text-gray-400 dark:text-gray-500 text-sm tracking-wider uppercase transition-colors">Jenis Sampah</th>
                                <th class="pb-4 font-bold text-gray-400 dark:text-gray-500 text-sm tracking-wider uppercase transition-colors">Tipe</th>
                                <th class="pb-4 font-bold text-gray-400 dark:text-gray-500 text-sm tracking-wider uppercase transition-colors">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-white/5 transition-colors">
                            @forelse($recent_transactions ?? [] as $trx)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                                <td class="py-5 font-semibold text-gray-500 dark:text-gray-400 transition-colors">{{ $trx->created_at->format('d M Y') }}</td>
                                <td class="py-5 font-bold text-gray-800 dark:text-gray-200 transition-colors">{{ $trx->jenis_sampah }}</td>
                                <td class="py-5">
                                    <span class="px-4 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider {{ $trx->type === 'deposit' ? 'bg-green-100 dark:bg-green-500/10 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-500/20' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700' }} transition-colors">
                                        {{ $trx->type }}
                                    </span>
                                </td>
                                <td class="py-5">
                                    <span class="px-4 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors
                                        {{ $trx->status === 'pending' ? 'bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20' : '' }}
                                        {{ $trx->status === 'approved' ? 'bg-green-100 dark:bg-green-500/10 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-500/20' : '' }}
                                        {{ $trx->status === 'rejected' ? 'bg-red-100 dark:bg-red-500/10 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-500/20' : '' }}
                                    ">
                                        {{ $trx->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-gray-500 font-medium bg-gray-50 dark:bg-white/5 rounded-2xl mt-4 border border-gray-100 dark:border-white/5 transition-colors">Belum ada transaksi. Ayo mulai setor sampah!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>