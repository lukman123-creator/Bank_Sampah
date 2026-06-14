<x-admin-layout>
    <div class="flex items-center justify-between mb-8 animate-slideUp">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight transition-colors">Dashboard</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 text-green-700 dark:text-green-400 px-6 py-4 rounded-2xl mb-8 shadow-sm flex items-center gap-3 animate-slideUp transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Top Widgets -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Widget 1 -->
        <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2rem] p-6 shadow-xl hover:-translate-y-1 transition-all duration-300 animate-slideUp" style="animation-delay: 0.2s;">
            <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 transition-colors">Total Setoran Sampah</h3>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-3xl font-extrabold text-gray-900 dark:text-white transition-colors" x-data="numberCounter({{ $transactions->where('type', 'deposit')->count() }})"><span x-text="formatted()"></span> <span class="text-lg font-medium text-gray-400 dark:text-gray-500 transition-colors">trx</span></div>
                    <div class="text-xs font-semibold text-green-600 dark:text-green-400 mt-2 flex items-center gap-1 transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        12% from last month
                    </div>
                </div>
                <div class="w-16 h-12 bg-gray-50 dark:bg-white/5 rounded-lg flex items-end justify-around p-2 border border-gray-100 dark:border-white/5 transition-colors">
                    <div class="w-2 h-4 bg-green-500/40 rounded-sm"></div>
                    <div class="w-2 h-6 bg-green-500/70 rounded-sm"></div>
                    <div class="w-2 h-8 bg-green-500 dark:bg-green-400 rounded-sm transition-colors"></div>
                </div>
            </div>
        </div>

        <!-- Widget 2 -->
        <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2rem] p-6 shadow-xl hover:-translate-y-1 transition-all duration-300 animate-slideUp" style="animation-delay: 0.3s;">
            <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 transition-colors">Setoran Pending</h3>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-3xl font-extrabold text-gray-900 dark:text-white transition-colors" x-data="numberCounter({{ $transactions->where('status', 'pending')->count() }})" x-text="formatted()"></div>
                    <div class="text-xs font-semibold text-amber-600 dark:text-amber-400 mt-2 flex items-center gap-1 transition-colors">
                        Menunggu verifikasi
                    </div>
                </div>
                <div class="w-16 h-12 bg-gray-50 dark:bg-white/5 rounded-lg flex items-end justify-around p-2 border border-gray-100 dark:border-white/5 transition-colors">
                    <div class="w-2 h-5 bg-amber-500/40 rounded-sm"></div>
                    <div class="w-2 h-3 bg-amber-500/70 rounded-sm"></div>
                    <div class="w-2 h-7 bg-amber-500 dark:bg-amber-400 rounded-sm transition-colors"></div>
                </div>
            </div>
        </div>

        <!-- Widget 3 -->
        <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2rem] p-6 shadow-xl hover:-translate-y-1 transition-all duration-300 animate-slideUp" style="animation-delay: 0.4s;">
            <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 transition-colors">Total Payout</h3>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-3xl font-extrabold text-gray-900 dark:text-white transition-colors" x-data="numberCounter({{ $transactions->where('type', 'withdrawal')->where('status', 'sukses')->sum('total_harga') }}, true)">Rp <span x-text="formatted()"></span></div>
                    <div class="text-xs font-semibold text-green-600 dark:text-green-400 mt-2 flex items-center gap-1 transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        8.5% from last month
                    </div>
                </div>
                <div class="w-16 h-12 bg-gray-50 dark:bg-white/5 rounded-lg flex items-end justify-around p-2 border border-gray-100 dark:border-white/5 transition-colors">
                    <div class="w-2 h-3 bg-green-500/40 rounded-sm"></div>
                    <div class="w-2 h-7 bg-green-500/70 rounded-sm"></div>
                    <div class="w-2 h-5 bg-green-500 dark:bg-green-400 rounded-sm transition-colors"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 rounded-[2.5rem] p-6 md:p-8 shadow-2xl animate-slideUp transition-colors duration-300" style="animation-delay: 0.5s;">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 transition-colors">Verifikasi Transaksi</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-white/10 transition-colors">
                        <th class="py-4 font-bold text-gray-500 dark:text-gray-500 text-xs uppercase tracking-wider transition-colors">Date & Time</th>
                        <th class="py-4 font-bold text-gray-500 dark:text-gray-500 text-xs uppercase tracking-wider transition-colors">Trx Code</th>
                        <th class="py-4 font-bold text-gray-500 dark:text-gray-500 text-xs uppercase tracking-wider transition-colors">User</th>
                        <th class="py-4 font-bold text-gray-500 dark:text-gray-500 text-xs uppercase tracking-wider transition-colors">Waste Type</th>
                        <th class="py-4 font-bold text-gray-500 dark:text-gray-500 text-xs uppercase tracking-wider transition-colors">Weight</th>
                        <th class="py-4 font-bold text-gray-500 dark:text-gray-500 text-xs uppercase tracking-wider transition-colors">Payout</th>
                        <th class="py-4 font-bold text-gray-500 dark:text-gray-500 text-xs uppercase tracking-wider text-center transition-colors">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5 transition-colors">
                    @forelse($transactions ?? [] as $trx)
                    @php /** @var \App\Models\Transaction $trx */ @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                        <td class="py-4 text-sm text-gray-600 dark:text-gray-400 font-medium transition-colors">{{ $trx->created_at->format('d M, Y \a\t H:i') }}</td>
                        <td class="py-4 font-mono text-xs font-bold text-gray-500 dark:text-gray-400 transition-colors">{{ $trx->reference_code }}</td>
                        <td class="py-4 text-sm font-bold text-gray-800 dark:text-gray-200 flex items-center gap-3 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-white/10 flex items-center justify-center text-xs text-gray-800 dark:text-white border border-gray-200 dark:border-white/10 transition-colors">
                                {{ substr($trx->user->name, 0, 1) }}
                            </div>
                            {{ $trx->user->name }}
                        </td>
                        <td class="py-4">
                            <span class="px-3 py-1 rounded-lg text-xs font-bold bg-gray-100 dark:bg-white/5 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-white/10 transition-colors">
                                {{ $trx->jenis_sampah }}
                            </span>
                        </td>
                        <td class="py-4 text-sm font-semibold text-gray-700 dark:text-gray-300 transition-colors">{{ $trx->berat_kg }} kg</td>
                        <td class="py-4 font-bold text-green-600 dark:text-green-400 transition-colors">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
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
                                <span class="px-4 py-2 rounded-xl text-xs font-bold capitalize transition-colors
                                    {{ $trx->status === 'approved' ? 'bg-green-100 dark:bg-green-500/10 text-green-700 dark:text-green-400 border border-green-200 dark:border-green-500/20' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700' }}">
                                    {{ $trx->status }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-gray-500 font-medium bg-gray-50 dark:bg-white/5 rounded-2xl mt-4 border border-gray-100 dark:border-white/5 transition-colors">No transactions awaiting verification.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>