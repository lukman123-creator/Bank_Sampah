<x-admin-layout>
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard</h1>
        <button class="bg-[#072d22] hover:bg-[#0a382a] text-white px-5 py-2.5 rounded-xl font-semibold shadow-md transition-colors text-sm">
            Add Custom Widget
        </button>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl mb-8 shadow-sm flex items-center gap-3">
            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Top Widgets (AeuxGlobal Style) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Widget 1 -->
        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-shadow">
            <h3 class="text-sm font-semibold text-gray-400 mb-1">Total Setoran Sampah</h3>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-3xl font-extrabold text-gray-800">{{ $transactions->count() }} <span class="text-lg font-medium text-gray-500">trx</span></div>
                    <div class="text-xs font-semibold text-emerald-500 mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        12% from last month
                    </div>
                </div>
                <div class="w-16 h-12 bg-emerald-50 rounded-lg flex items-end justify-around p-2">
                    <div class="w-2 h-4 bg-emerald-300 rounded-sm"></div>
                    <div class="w-2 h-6 bg-emerald-400 rounded-sm"></div>
                    <div class="w-2 h-8 bg-emerald-600 rounded-sm"></div>
                </div>
            </div>
        </div>

        <!-- Widget 2 -->
        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-shadow">
            <h3 class="text-sm font-semibold text-gray-400 mb-1">Setoran Pending</h3>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-3xl font-extrabold text-gray-800">{{ $transactions->where('status', 'pending')->count() }}</div>
                    <div class="text-xs font-semibold text-orange-500 mt-2 flex items-center gap-1">
                        Menunggu verifikasi
                    </div>
                </div>
                <div class="w-16 h-12 bg-orange-50 rounded-lg flex items-end justify-around p-2">
                    <div class="w-2 h-5 bg-orange-300 rounded-sm"></div>
                    <div class="w-2 h-3 bg-orange-400 rounded-sm"></div>
                    <div class="w-2 h-7 bg-orange-600 rounded-sm"></div>
                </div>
            </div>
        </div>

        <!-- Widget 3 -->
        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-shadow">
            <h3 class="text-sm font-semibold text-gray-400 mb-1">Total Payout</h3>
            <div class="flex items-end justify-between">
                <div>
                    <div class="text-3xl font-extrabold text-gray-800">Rp {{ number_format($transactions->where('status', 'approved')->sum('total_harga'), 0, ',', '.') }}</div>
                    <div class="text-xs font-semibold text-emerald-500 mt-2 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        8.5% from last month
                    </div>
                </div>
                <div class="w-16 h-12 bg-emerald-50 rounded-lg flex items-end justify-around p-2">
                    <div class="w-2 h-3 bg-emerald-300 rounded-sm"></div>
                    <div class="w-2 h-7 bg-emerald-400 rounded-sm"></div>
                    <div class="w-2 h-5 bg-emerald-600 rounded-sm"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="bg-white border border-gray-100 rounded-3xl p-6 md:p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Verifikasi Transaksi</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="py-4 font-bold text-gray-400 text-xs uppercase tracking-wider">Date & Time</th>
                        <th class="py-4 font-bold text-gray-400 text-xs uppercase tracking-wider">User</th>
                        <th class="py-4 font-bold text-gray-400 text-xs uppercase tracking-wider">Waste Type</th>
                        <th class="py-4 font-bold text-gray-400 text-xs uppercase tracking-wider">Weight</th>
                        <th class="py-4 font-bold text-gray-400 text-xs uppercase tracking-wider">Payout</th>
                        <th class="py-4 font-bold text-gray-400 text-xs uppercase tracking-wider text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($transactions ?? [] as $trx)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="py-4 text-sm text-gray-600 font-medium">{{ $trx->created_at->format('d M, Y \a\t H:i') }}</td>
                        <td class="py-4 text-sm font-bold text-gray-900 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs text-gray-600">
                                {{ substr($trx->user->name, 0, 1) }}
                            </div>
                            {{ $trx->user->name }}
                        </td>
                        <td class="py-4">
                            <span class="px-3 py-1 rounded-lg text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                {{ $trx->jenis_sampah }}
                            </span>
                        </td>
                        <td class="py-4 text-sm font-semibold text-gray-700">{{ $trx->berat_kg }} kg</td>
                        <td class="py-4 font-bold text-[#072d22]">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                        <td class="py-4 text-center">
                            @if($trx->status === 'pending' && $trx->type === 'deposit')
                                <form action="{{ route('admin.transactions.approve', $trx->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-[#072d22] hover:bg-[#0a382a] text-white font-bold py-2 px-5 rounded-xl shadow-md hover:shadow-lg transition-all text-xs tracking-wide">
                                        Approve
                                    </button>
                                </form>
                            @else
                                <span class="px-4 py-2 rounded-xl text-xs font-bold capitalize shadow-sm
                                    {{ $trx->status === 'approved' ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $trx->status }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-gray-400 font-medium">No transactions awaiting verification.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>