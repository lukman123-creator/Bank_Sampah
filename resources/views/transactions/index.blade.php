<x-app-layout>
    <!-- Background styling to enforce Light Theme (GreenMarket Style) -->
    <style>
        body { background-color: #f8fbf8 !important; }
        .dark body { background-color: #f8fbf8 !important; } /* Force light mode feel */
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-[#e5f3ea] border border-[#108945]/30 text-[#108945] px-6 py-4 rounded-2xl mb-8 shadow-sm flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Hero/Header Section -->
            <div class="mb-10">
                <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2">Trans<span class="text-[#108945]">aksi</span></h2>
                <p class="text-gray-500 font-medium text-lg">Setor sampah organik atau anorganikmu dan mulai kumpulkan saldo dompetmu hari ini.</p>
            </div>

            <!-- Setor Sampah Form -->
            <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-[0_10px_40px_rgb(0,0,0,0.05)] border border-gray-100 mb-10 relative overflow-hidden">
                <!-- Decorative Element -->
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-[#f0f7f2] rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
                
                <h3 class="text-2xl font-bold mb-8 text-gray-800 relative z-10 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#e5f3ea] flex items-center justify-center text-[#108945]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </div>
                    Setor Sampah Baru
                </h3>

                <form action="{{ route('transactions.store') }}" method="POST" class="relative z-10">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                        <div class="md:col-span-5">
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Jenis Sampah</label>
                            <select name="jenis_sampah" class="block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3.5 text-gray-700 focus:border-[#108945] focus:ring-[#108945] focus:bg-white transition-colors">
                                <option value="Plastik">Plastik (Botol, Gelas, dll)</option>
                                <option value="Kertas">Kertas (Kardus, Koran, dll)</option>
                                <option value="Logam">Logam (Besi, Kaleng, dll)</option>
                            </select>
                        </div>
                        <div class="md:col-span-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Berat (Kg)</label>
                            <div class="relative">
                                <input type="number" step="0.1" name="berat_kg" class="block w-full rounded-2xl border-gray-200 bg-gray-50 px-4 py-3.5 text-gray-700 focus:border-[#108945] focus:ring-[#108945] focus:bg-white transition-colors" placeholder="0.0" required>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <span class="text-gray-400 font-medium">Kg</span>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-3">
                            <button type="submit" class="w-full bg-[#108945] text-white font-bold px-6 py-4 rounded-2xl hover:bg-[#0c6b35] shadow-lg hover:shadow-green-900/20 transition-all duration-300 flex justify-center items-center gap-2">
                                <span>Submit</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Transaction History Table -->
            <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-[0_10px_40px_rgb(0,0,0,0.05)] border border-gray-100">
                <h3 class="text-2xl font-bold mb-8 text-gray-800">Riwayat Setoran</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="border-b-2 border-gray-100">
                                <th class="pb-4 font-bold text-gray-400 text-sm uppercase tracking-wider">Tanggal</th>
                                <th class="pb-4 font-bold text-gray-400 text-sm uppercase tracking-wider">Jenis Sampah</th>
                                <th class="pb-4 font-bold text-gray-400 text-sm uppercase tracking-wider">Berat</th>
                                <th class="pb-4 font-bold text-gray-400 text-sm uppercase tracking-wider">Tipe</th>
                                <th class="pb-4 font-bold text-gray-400 text-sm uppercase tracking-wider">Pendapatan</th>
                                <th class="pb-4 font-bold text-gray-400 text-sm uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($transactions as $trx)
                            <tr class="hover:bg-[#f8fbf8] transition-colors group">
                                <td class="py-5 font-semibold text-gray-600">{{ $trx->created_at->format('d M Y') }}</td>
                                <td class="py-5 font-bold text-gray-900">{{ $trx->jenis_sampah }}</td>
                                <td class="py-5 font-semibold text-gray-700">{{ floatval($trx->berat_kg) }} Kg</td>
                                <td class="py-5">
                                    <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider {{ $trx->type === 'deposit' ? 'bg-[#e5f3ea] text-[#108945]' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $trx->type }}
                                    </span>
                                </td>
                                <td class="py-5 font-black text-[#108945]">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                <td class="py-5">
                                    <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider
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
                                <td colspan="6" class="py-12 text-center text-gray-400 font-medium bg-gray-50 rounded-2xl mt-4">Belum ada riwayat transaksi. Ayo setor sampah pertamamu!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
