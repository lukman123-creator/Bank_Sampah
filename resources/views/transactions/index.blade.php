<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 text-green-700 dark:text-green-400 px-6 py-4 rounded-2xl mb-8 shadow-[0_0_15px_rgba(34,197,94,0.1)] flex items-center gap-3 animate-slideUp transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Hero/Header Section -->
            <div class="mb-10 animate-slideUp" style="animation-delay: 0.2s;">
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-2 transition-colors">Trans<span class="text-green-600 dark:text-green-500">aksi</span></h2>
                <p class="text-gray-600 dark:text-gray-400 font-medium text-lg transition-colors">Setor sampah organik atau anorganikmu dan mulai kumpulkan saldo dompetmu hari ini.</p>
            </div>

            <!-- Setor Sampah Form -->
            <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl rounded-[2.5rem] p-8 lg:p-10 shadow-2xl border border-gray-200 dark:border-white/10 mb-10 relative overflow-hidden animate-slideUp transition-colors duration-300" style="animation-delay: 0.4s;">
                <!-- Decorative Element -->
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-green-500/5 dark:bg-green-500/10 rounded-full mix-blend-overlay filter blur-3xl opacity-50 transition-colors"></div>
                
                <h3 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white relative z-10 flex items-center gap-3 transition-colors">
                    <div class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 flex items-center justify-center text-green-600 dark:text-green-400 shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </div>
                    Setor Sampah Baru
                </h3>

                <form action="{{ route('transactions.store') }}" method="POST" class="relative z-10">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                        <div class="md:col-span-5">
                            <label class="block text-sm font-bold text-gray-600 dark:text-gray-400 mb-2 uppercase tracking-wide transition-colors">Jenis Sampah</label>
                            <select name="jenis_sampah" class="block w-full rounded-2xl border-gray-300 dark:border-white/10 bg-gray-50 dark:bg-white/5 px-4 py-3.5 text-gray-900 dark:text-white focus:border-green-600 dark:focus:border-green-500 focus:ring-green-600 dark:focus:ring-green-500 focus:bg-white dark:focus:bg-white/10 transition-colors">
                                <option class="bg-white dark:bg-gray-900" value="Plastik">Plastik (Botol, Gelas, dll)</option>
                                <option class="bg-white dark:bg-gray-900" value="Kertas">Kertas (Kardus, Koran, dll)</option>
                                <option class="bg-white dark:bg-gray-900" value="Logam">Logam (Besi, Kaleng, dll)</option>
                            </select>
                        </div>
                        <div class="md:col-span-4">
                            <label class="block text-sm font-bold text-gray-600 dark:text-gray-400 mb-2 uppercase tracking-wide transition-colors">Berat (Kg)</label>
                            <div class="relative">
                                <input type="number" step="0.1" name="berat_kg" class="block w-full rounded-2xl border-gray-300 dark:border-white/10 bg-gray-50 dark:bg-white/5 px-4 py-3.5 text-gray-900 dark:text-white focus:border-green-600 dark:focus:border-green-500 focus:ring-green-600 dark:focus:ring-green-500 focus:bg-white dark:focus:bg-white/10 transition-colors placeholder-gray-400 dark:placeholder-gray-600" placeholder="0.0" required>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-gray-400 dark:text-gray-500 font-medium transition-colors">Kg</span>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-3">
                            <button type="submit" class="w-full bg-[#108945] text-white font-bold px-6 py-3.5 rounded-2xl hover:bg-[#0c6b35] shadow-[0_0_15px_rgba(16,137,69,0.4)] hover:shadow-[0_0_25px_rgba(16,137,69,0.6)] transition-all duration-300 flex justify-center items-center gap-2 border border-transparent">
                                <span>Submit</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Transaction History Table -->
            <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl rounded-[2.5rem] p-8 lg:p-10 shadow-2xl border border-gray-200 dark:border-white/10 animate-slideUp transition-colors duration-300" style="animation-delay: 0.6s;">
                <h3 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white transition-colors">Riwayat Setoran</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-white/10 transition-colors">
                                <th class="pb-4 font-bold text-gray-500 dark:text-gray-500 text-sm uppercase tracking-wider transition-colors">Tanggal</th>
                                <th class="pb-4 font-bold text-gray-500 dark:text-gray-500 text-sm uppercase tracking-wider transition-colors">Jenis Sampah</th>
                                <th class="pb-4 font-bold text-gray-500 dark:text-gray-500 text-sm uppercase tracking-wider transition-colors">Berat</th>
                                <th class="pb-4 font-bold text-gray-500 dark:text-gray-500 text-sm uppercase tracking-wider transition-colors">Tipe</th>
                                <th class="pb-4 font-bold text-gray-500 dark:text-gray-500 text-sm uppercase tracking-wider transition-colors">Pendapatan</th>
                                <th class="pb-4 font-bold text-gray-500 dark:text-gray-500 text-sm uppercase tracking-wider transition-colors">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-white/5 transition-colors">
                            @forelse($transactions as $trx)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                                <td class="py-5 font-semibold text-gray-600 dark:text-gray-400 transition-colors">{{ $trx->created_at->format('d M Y') }}</td>
                                <td class="py-5 font-bold text-gray-800 dark:text-gray-200 transition-colors">{{ $trx->jenis_sampah }}</td>
                                <td class="py-5 font-semibold text-gray-700 dark:text-gray-300 transition-colors">{{ floatval($trx->berat_kg) }} Kg</td>
                                <td class="py-5">
                                    <span class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider {{ $trx->type === 'deposit' ? 'bg-green-100 dark:bg-green-500/10 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-500/20' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700' }} transition-colors">
                                        {{ $trx->type }}
                                    </span>
                                </td>
                                <td class="py-5 font-black text-green-600 dark:text-green-400 transition-colors">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                <td class="py-5">
                                    <span class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider transition-colors
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
                                <td colspan="6" class="py-12 text-center text-gray-500 font-medium bg-gray-50 dark:bg-white/5 rounded-2xl mt-4 border border-gray-100 dark:border-white/5 transition-colors">Belum ada riwayat transaksi. Ayo setor sampah pertamamu!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
