<x-admin-layout>
    <div class="flex items-center justify-between mb-8 animate-slideUp">
        <h1 class="text-3xl font-extrabold text-white tracking-tight">Dashboard</h1>
        <button class="bg-[#108945] hover:bg-[#0c6b35] text-white px-5 py-2.5 rounded-xl font-semibold shadow-[0_0_15px_rgba(16,137,69,0.4)] transition-all text-sm border border-transparent">
            Add Custom Widget
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-6 py-4 rounded-2xl mb-8 shadow-sm flex items-center gap-3 animate-slideUp">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Top Widgets -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Widget 1 -->
        <div class="bg-[#0a110d]/60 backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 shadow-xl hover:-translate-y-1 transition-transform animate-slideUp" style="animation-delay: 0.2s;">
            <h3 class="text-sm font-semibold text-gray-400 mb-1">Total Setoran Sampah</h3>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-3xl font-extrabold text-white">{{ $transactions->count() }} <span class="text-lg font-medium text-gray-500">trx</span></div>
                    <div class="text-xs font-semibold text-green-400 mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        12% from last month
                    </div>
                </div>
                <div class="w-16 h-12 bg-white/5 rounded-lg flex items-end justify-around p-2 border border-white/5">
                    <div class="w-2 h-4 bg-green-500/40 rounded-sm"></div>
                    <div class="w-2 h-6 bg-green-500/70 rounded-sm"></div>
                    <div class="w-2 h-8 bg-green-400 rounded-sm"></div>
                </div>
            </div>
        </div>

        <!-- Widget 2 -->
        <div class="bg-[#0a110d]/60 backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 shadow-xl hover:-translate-y-1 transition-transform animate-slideUp" style="animation-delay: 0.3s;">
            <h3 class="text-sm font-semibold text-gray-400 mb-1">Setoran Pending</h3>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-3xl font-extrabold text-white">{{ $transactions->where('status', 'pending')->count() }}</div>
                    <div class="text-xs font-semibold text-amber-400 mt-2 flex items-center gap-1">
                        Menunggu verifikasi
                    </div>
                </div>
                <div class="w-16 h-12 bg-white/5 rounded-lg flex items-end justify-around p-2 border border-white/5">
                    <div class="w-2 h-5 bg-amber-500/40 rounded-sm"></div>
                    <div class="w-2 h-3 bg-amber-500/70 rounded-sm"></div>
                    <div class="w-2 h-7 bg-amber-400 rounded-sm"></div>
                </div>
            </div>
        </div>

        <!-- Widget 3 -->
        <div class="bg-[#0a110d]/60 backdrop-blur-xl border border-white/10 rounded-[2rem] p-6 shadow-xl hover:-translate-y-1 transition-transform animate-slideUp" style="animation-delay: 0.4s;">
            <h3 class="text-sm font-semibold text-gray-400 mb-1">Total Payout</h3>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-3xl font-extrabold text-white">Rp {{ number_format($transactions->where('status', 'approved')->sum('total_harga'), 0, ',', '.') }}</div>
                    <div class="text-xs font-semibold text-green-400 mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        8.5% from last month
                    </div>
                </div>
                <div class="w-16 h-12 bg-white/5 rounded-lg flex items-end justify-around p-2 border border-white/5">
                    <div class="w-2 h-3 bg-green-500/40 rounded-sm"></div>
                    <div class="w-2 h-7 bg-green-500/70 rounded-sm"></div>
                    <div class="w-2 h-5 bg-green-400 rounded-sm"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="bg-[#0a110d]/60 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-6 md:p-8 shadow-2xl animate-slideUp" style="animation-delay: 0.5s;">
        <h2 class="text-xl font-bold text-white mb-6">Verifikasi Transaksi</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/10">
                        <th class="py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Date & Time</th>
                        <th class="py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">User</th>
                        <th class="py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Waste Type</th>
                        <th class="py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Weight</th>
                        <th class="py-4 font-bold text-gray-500 text-xs uppercase tracking-wider">Payout</th>
                        <th class="py-4 font-bold text-gray-500 text-xs uppercase tracking-wider text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($transactions ?? [] as $trx)
                    <tr class="hover:bg-white/5 transition-colors group">
                        <td class="py-4 text-sm text-gray-400 font-medium">{{ $trx->created_at->format('d M, Y \a\t H:i') }}</td>
                        <td class="py-4 text-sm font-bold text-gray-200 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs text-white border border-white/10">
                                {{ substr($trx->user->name, 0, 1) }}
                            </div>
                            {{ $trx->user->name }}
                        </td>
                        <td class="py-4">
                            <span class="px-3 py-1 rounded-lg text-xs font-bold bg-white/5 text-gray-300 border border-white/10">
                                {{ $trx->jenis_sampah }}
                            </span>
                        </td>
                        <td class="py-4 text-sm font-semibold text-gray-300">{{ $trx->berat_kg }} kg</td>
                        <td class="py-4 font-bold text-green-400">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                        <td class="py-4 text-center">
                            @if($trx->status === 'pending' && $trx->type === 'deposit')
                                <form action="{{ route('admin.transactions.approve', $trx->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-[#108945] hover:bg-[#0c6b35] text-white font-bold py-2 px-5 rounded-xl shadow-[0_0_10px_rgba(16,137,69,0.3)] transition-all text-xs tracking-wide border border-transparent">
                                        Approve
                                    </button>
                                </form>
                            @else
                                <span class="px-4 py-2 rounded-xl text-xs font-bold capitalize
                                    {{ $trx->status === 'approved' ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-gray-800 text-gray-400 border border-gray-700' }}">
                                    {{ $trx->status }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-gray-500 font-medium bg-white/5 rounded-2xl mt-4 border border-white/5">No transactions awaiting verification.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>