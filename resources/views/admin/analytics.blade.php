<x-admin-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Laporan <span class="text-emerald-600">Transaksi</span></h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Rekapitulasi riwayat transaksi berdasarkan periode waktu.</p>
                </div>
                
                <div class="flex flex-wrap items-center gap-3">
                    <!-- FITUR FILTER BULAN DAN TAHUN -->
                    <form method="GET" action="{{ route('admin.analytics') }}" class="flex items-center gap-2 bg-white dark:bg-gray-800 p-1.5 rounded-lg border border-gray-300 dark:border-gray-600 shadow-sm">
                        <select name="month" class="border-none bg-transparent text-sm font-medium text-gray-700 dark:text-gray-300 focus:ring-0 cursor-pointer">
                            @foreach(range(1, 12) as $m)
                                <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}" {{ $month == $m ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endforeach
                        </select>
                        <select name="year" class="border-none bg-transparent text-sm font-medium text-gray-700 dark:text-gray-300 focus:ring-0 cursor-pointer border-l border-gray-200 dark:border-gray-700">
                            @foreach(range(date('Y')-2, date('Y')) as $y)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded text-sm font-bold transition">Filter</button>
                    </form>

                    <button onclick="window.print()" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 font-bold py-2 px-4 rounded-lg transition-colors shadow-sm flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Cetak PDF
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex flex-col justify-center">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Total Saldo Diberikan (In)</p>
                    <p class="text-3xl font-black text-emerald-600">Rp {{ number_format($totalDeposit, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-400 mt-2">Dari total {{ floatval($totalBerat) }} Kg Sampah</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm flex flex-col justify-center">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Total Payout / Tukar (Out)</p>
                    <p class="text-3xl font-black text-red-500">Rp {{ number_format($totalTarik, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-400 mt-2">Uang tunai & barang diklaim</p>
                </div>
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-6 rounded-xl shadow-sm flex flex-col justify-center text-white">
                    <p class="text-xs font-bold text-blue-100 uppercase tracking-wider mb-1">Dana Mengendap (Float)</p>
                    <p class="text-3xl font-black">Rp {{ number_format($totalDeposit - $totalTarik, 0, ',', '.') }}</p>
                    <p class="text-sm text-blue-100 mt-2">Selisih Kas Warga Bulan Ini</p>
                </div>
            </div>

            <!-- AREA 2 GRAFIK (CHART.JS) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Chart 1: Cashflow Doughnut -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Cash Flow (Masuk vs Keluar)</h3>
                    <div class="relative w-full h-64 flex justify-center">
                        @if($totalDeposit > 0 || $totalTarik > 0)
                            <canvas id="cashflowChart"></canvas>
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400 text-sm">Tidak ada data keuangan bulan ini.</div>
                        @endif
                    </div>
                </div>

                <!-- Chart 2: Volume Sampah Bar -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Volume Sampah Terkumpul (Kg)</h3>
                    <div class="relative w-full h-64">
                        @if($barLabels != '[]')
                            <canvas id="wasteBarChart"></canvas>
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400 text-sm">Tidak ada setoran sampah bulan ini.</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm rounded-xl overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800 dark:text-gray-200">Rincian Transaksi ({{ date('F Y', mktime(0, 0, 0, $month, 1, $year)) }})</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tanggal</th>
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kode Trx</th>
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nasabah</th>
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jenis Transaksi</th>
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nominal</th>
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse($allTransactions as $trx)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($trx->created_at)->format('d/m/Y H:i') }}</td>
                                    <td class="py-4 px-6"><span class="font-mono text-xs font-bold text-gray-700 dark:text-gray-300">{{ $trx->reference_code ?? $trx->trx_code ?? '-' }}</span></td>
                                    <td class="py-4 px-6 text-sm font-bold text-gray-900 dark:text-white">{{ $trx->user->name ?? 'User Dihapus' }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-600 dark:text-gray-400 max-w-[200px] truncate">
                                        {{ $trx->jenis_sampah }}
                                        @if($trx->berat_kg) <span class="text-xs text-gray-400 ml-1">({{ floatval($trx->berat_kg) }} Kg)</span> @endif
                                    </td>
                                    <td class="py-4 px-6 text-sm font-bold {{ in_array($trx->type, ['deposit', 'penjualan']) ? 'text-emerald-600' : 'text-red-500' }}">
                                        {{ in_array($trx->type, ['deposit', 'penjualan']) ? '+' : '-' }} Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($trx->status === 'sukses' || $trx->status === 'approved')
                                            <span class="px-2.5 py-1 rounded text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200 uppercase">Selesai</span>
                                        @elseif($trx->status === 'pending')
                                            <span class="px-2.5 py-1 rounded text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200 uppercase">Pending</span>
                                        @else
                                            <span class="px-2.5 py-1 rounded text-xs font-bold bg-gray-100 text-gray-800 border border-gray-200 uppercase">{{ $trx->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-gray-500 dark:text-gray-400 text-sm">Tidak ada transaksi pada periode bulan dan tahun ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- SCRIPT LIBRARY CHART.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Render Doughnut Chart (Cashflow)
            @if($totalDeposit > 0 || $totalTarik > 0)
            const ctxDoughnut = document.getElementById('cashflowChart').getContext('2d');
            new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: ['Setoran Masuk (In)', 'Payout Warga (Out)'],
                    datasets: [{
                        data: [{{ $totalDeposit }}, {{ $totalTarik }}],
                        backgroundColor: ['rgba(16, 185, 129, 0.8)', 'rgba(239, 68, 68, 0.8)'],
                        borderColor: ['#fff', '#fff'],
                        borderWidth: 2,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } },
                    cutout: '70%'
                }
            });
            @endif

            // Render Bar Chart (Volume Sampah)
            @if($barLabels != '[]')
            const ctxBar = document.getElementById('wasteBarChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: {!! $barLabels !!},
                    datasets: [{
                        label: 'Total Volume (Kg)',
                        data: {!! $barData !!},
                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                        borderColor: 'rgb(59, 130, 246)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { borderDash: [2, 4] } },
                        x: { grid: { display: false } }
                    }
                }
            });
            @endif
        });
    </script>
</x-admin-layout>