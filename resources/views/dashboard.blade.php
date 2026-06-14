<x-app-layout>
    <!-- Background styling to enforce Light Theme (GreenMarket Style) -->
    <style>
        body { background-color: #f8fbf8 !important; }
        .dark body { background-color: #f8fbf8 !important; } /* Force light mode feel for GreenMarket theme */
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Hero Section / Welcome Banner -->
            <div class="relative bg-[#108945] rounded-[2rem] overflow-hidden shadow-2xl mb-10 text-white">
                <div class="absolute inset-0 opacity-20" style="background-image: url('https://images.unsplash.com/photo-1550989460-0adf9ea622e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1080&q=80'); background-size: cover; background-position: center;"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#108945] to-transparent"></div>
                
                <div class="relative z-10 p-10 md:p-16 flex flex-col justify-center min-h-[300px]">
                    <span class="inline-block px-4 py-1.5 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold tracking-wide mb-4 w-fit">Welcome Back, {{ Auth::user()->name }}</span>
                    <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4 tracking-tight">
                        Growing Green <br> <span class="text-green-200">Together</span>
                    </h2>
                    <p class="text-green-100 max-w-lg text-lg font-medium leading-relaxed">
                        At Bank Sampah, we see recycling as a way of life. Start sorting your waste today, help us grow a greener future with ease and confidence.
                    </p>
                </div>
            </div>

            <!-- Stats Section (Cards) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Card 1 -->
                <div class="bg-white rounded-3xl p-8 shadow-[0_10px_40px_rgb(0,0,0,0.05)] border border-gray-100 flex items-center justify-between group hover:-translate-y-1 transition-transform duration-300">
                    <div>
                        <h4 class="text-gray-400 font-bold uppercase tracking-wider text-sm mb-2">Total Sampah Disetor</h4>
                        <p class="text-5xl font-black text-gray-800">{{ $total_berat ?? 0 }}<span class="text-2xl font-bold text-gray-400 ml-1">Kg</span></p>
                        <p class="text-sm font-semibold text-[#108945] mt-4 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            Berkontribusi aktif
                        </p>
                    </div>
                    <div class="w-32 h-32 rounded-2xl overflow-hidden shadow-lg group-hover:scale-105 transition-transform duration-500">
                        <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Recycling" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-3xl p-8 shadow-[0_10px_40px_rgb(0,0,0,0.05)] border border-gray-100 flex items-center justify-between group hover:-translate-y-1 transition-transform duration-300">
                    <div>
                        <h4 class="text-gray-400 font-bold uppercase tracking-wider text-sm mb-2">Saldo Dompet</h4>
                        <p class="text-5xl font-black text-gray-800"><span class="text-2xl font-bold text-gray-400 mr-1">Rp</span>{{ number_format($total_saldo ?? 0, 0, ',', '.') }}</p>
                        <p class="text-sm font-semibold text-[#108945] mt-4 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Tarik tunai kapan saja
                        </p>
                    </div>
                    <div class="w-32 h-32 rounded-2xl overflow-hidden shadow-lg bg-[#f0f7f2] flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                        <svg class="w-16 h-16 text-[#108945]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div class="bg-white rounded-3xl p-8 shadow-[0_10px_40px_rgb(0,0,0,0.05)] border border-gray-100">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-extrabold text-gray-800">Riwayat Setoran <span class="text-[#108945]">Terakhir</span></h3>
                    <a href="{{ route('transactions.index') }}" class="text-sm font-bold text-gray-500 hover:text-[#108945] flex items-center gap-1 transition-colors">
                        View All <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-100">
                                <th class="pb-4 font-bold text-gray-400 text-sm tracking-wide">Tanggal</th>
                                <th class="pb-4 font-bold text-gray-400 text-sm tracking-wide">Jenis Sampah</th>
                                <th class="pb-4 font-bold text-gray-400 text-sm tracking-wide">Tipe</th>
                                <th class="pb-4 font-bold text-gray-400 text-sm tracking-wide">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recent_transactions ?? [] as $trx)
                            <tr class="hover:bg-[#f8fbf8] transition-colors group">
                                <td class="py-5 font-semibold text-gray-700">{{ $trx->created_at->format('d M Y') }}</td>
                                <td class="py-5 font-bold text-gray-900">{{ $trx->jenis_sampah }}</td>
                                <td class="py-5">
                                    <span class="px-4 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider {{ $trx->type === 'deposit' ? 'bg-[#e5f3ea] text-[#108945]' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $trx->type }}
                                    </span>
                                </td>
                                <td class="py-5">
                                    <span class="px-4 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider
                                        {{ $trx->status === 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $trx->status === 'approved' ? 'bg-[#e5f3ea] text-[#108945]' : '' }}
                                        {{ $trx->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                                    ">
                                        {{ $trx->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-gray-400 font-medium bg-gray-50 rounded-xl mt-4">Belum ada transaksi. Ayo mulai setor sampah!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>