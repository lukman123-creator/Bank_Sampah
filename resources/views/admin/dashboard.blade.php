<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard Admin</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-5 shadow-sm border border-gray-200 dark:border-gray-700">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Total Setoran Warga</h3>
            <div class="flex items-end justify-between">
                <div class="text-2xl font-bold text-gray-800 dark:text-white" x-data="numberCounter({{ $transactions->where('type', 'deposit')->count() }})">
                    <span x-text="formatted()"></span> <span class="text-sm font-normal text-gray-500">trx</span>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg p-5 shadow-sm border border-gray-200 dark:border-gray-700">
            <h3 class="text-xs font-bold text-amber-600 uppercase tracking-wider mb-2">Antrean Pending</h3>
            <div class="flex items-end justify-between">
                <div class="text-2xl font-bold text-gray-800 dark:text-white" x-data="numberCounter({{ $transactions->where('status', 'pending')->count() }})">
                    <span x-text="formatted()"></span> <span class="text-sm font-normal text-gray-500">trx</span>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg p-5 shadow-sm border border-gray-200 dark:border-gray-700">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Total Payout / Tukar</h3>
            <div class="flex items-end justify-between">
                <div class="text-2xl font-bold text-emerald-600" x-data="numberCounter({{ $transactions->whereIn('type', ['withdrawal', 'redemption'])->where('status', 'sukses')->sum('total_harga') }}, true)">
                    Rp <span x-text="formatted()"></span>
                </div>
            </div>
        </div>
        @php
            $totalSemuaBerat = $transactions->where('type', 'deposit')->whereIn('status', ['sukses', 'approved'])->sum('berat_kg');
            $totalCo2Saved = $totalSemuaBerat * 2.5;
        @endphp
        <div class="bg-gradient-to-br from-teal-500 to-emerald-600 rounded-lg p-5 shadow-sm border border-transparent text-white relative overflow-hidden">
            <svg class="absolute -right-4 -bottom-4 w-24 h-24 text-white/20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
            <div class="relative z-10">
                <h3 class="text-xs font-bold text-teal-100 uppercase tracking-wider mb-2">Emisi CO₂ Dicegah</h3>
                <div class="flex items-end justify-between">
                    <div class="text-2xl font-bold">{{ number_format($totalCo2Saved, 1, ',', '.') }} <span class="text-sm font-normal text-teal-100">Kg</span></div>
                </div>
            </div>
        </div>
    </div>

    @php
        $chartData = \App\Models\Transaction::where('type', 'deposit')->whereIn('status', ['sukses', 'approved'])
            ->selectRaw('waste_type_id, sum(berat_kg) as total')->groupBy('waste_type_id')->with('wasteType')->get();
        $labels = $chartData->map(function($item) { return $item->wasteType->name ?? 'Lainnya'; })->toJson();
        $data = $chartData->pluck('total')->toJson();
    @endphp
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700 mb-8 w-full">
        <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-4">Statistik Volume Sampah per Jenis (Kg)</h3>
        <div class="relative h-72 w-full"><canvas id="wasteBarChart"></canvas></div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-8">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-emerald-50 dark:bg-emerald-900/10">
            <h2 class="text-lg font-bold text-emerald-800 dark:text-emerald-400">Rekapitulasi Setoran Sampah (In)</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase">Tanggal</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase">Kode</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase">Nasabah</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase">Jenis Sampah</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase">Berat Riil</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($transactions->where('type', 'deposit') as $trx)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 font-mono text-xs font-bold text-gray-700 dark:text-gray-300">{{ $trx->reference_code ?? $trx->trx_code }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $trx->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $trx->jenis_sampah }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white">{{ $trx->berat_kg ? floatval($trx->berat_kg) . ' Kg' : 'Menunggu Ditimbang' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded text-xs font-medium capitalize {{ $trx->status === 'sukses' || $trx->status === 'approved' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">{{ $trx->status === 'approved' ? 'sukses' : $trx->status }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">Belum ada data setoran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-8">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center bg-blue-50 dark:bg-blue-900/10">
            <h2 class="text-lg font-bold text-blue-800 dark:text-blue-400">Rekapitulasi Penarikan & Klaim Hadiah (Out)</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase">Tanggal</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase">Kode</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase">Nasabah</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase">Item Diklaim</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase">Nominal (Rp)</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($transactions->whereIn('type', ['withdrawal', 'redemption']) as $trx)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 font-mono text-xs font-bold text-gray-700 dark:text-gray-300">{{ $trx->reference_code ?? $trx->trx_code }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $trx->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $trx->jenis_sampah }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded text-xs font-medium capitalize {{ $trx->status === 'sukses' ? 'bg-emerald-100 text-emerald-800' : ($trx->status === 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800') }}">{{ $trx->status }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">Belum ada data penarikan/klaim.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('wasteBarChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! $labels !!},
                    datasets: [{
                        label: 'Total Volume (Kg)',
                        data: {!! $data !!},
                        backgroundColor: 'rgba(16, 185, 129, 0.6)',
                        borderColor: 'rgb(16, 185, 129)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, grid: { borderDash: [2, 4] } }, x: { grid: { display: false } } }
                }
            });
        });
    </script>
</x-admin-layout>