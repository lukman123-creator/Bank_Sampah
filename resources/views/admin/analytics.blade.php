<x-admin-layout>
    <!-- Tambahkan Chart.js script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-10 animate-slideUp">
                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-2 transition-colors">Data <span class="text-green-600 dark:text-green-500">Analytics</span></h2>
                <p class="text-gray-600 dark:text-gray-400 font-medium text-lg transition-colors">Statistik penukaran saldo dan penarikan tunai oleh user.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Chart Card -->
                <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 p-8 rounded-[2rem] shadow-xl animate-slideUp" style="animation-delay: 0.1s;">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Proporsi Penukaran Hadiah</h3>
                    
                    @if(count($chartData) > 0)
                        <div class="relative h-80 w-full flex justify-center">
                            <canvas id="withdrawChart"></canvas>
                        </div>
                    @else
                        <div class="h-80 flex items-center justify-center text-gray-500 dark:text-gray-400">
                            Belum ada data penukaran.
                        </div>
                    @endif
                </div>

                <!-- Data Table -->
                <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 p-8 rounded-[2rem] shadow-xl animate-slideUp overflow-hidden" style="animation-delay: 0.2s;">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Rincian Penarikan</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 dark:bg-white/5 border-b border-gray-200 dark:border-white/5 transition-colors">
                                    <th class="py-3 px-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jenis Penukaran</th>
                                    <th class="py-3 px-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-center">Jumlah TRX</th>
                                    <th class="py-3 px-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">Total Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-white/5 transition-colors">
                                @forelse($withdrawals as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                                        <td class="py-3 px-4 font-bold text-gray-900 dark:text-white truncate max-w-[150px]" title="{{ $item->jenis_sampah }}">{{ $item->jenis_sampah }}</td>
                                        <td class="py-3 px-4 text-center text-gray-600 dark:text-gray-400 font-medium">{{ $item->count }}</td>
                                        <td class="py-3 px-4 text-right text-green-600 dark:text-green-400 font-bold">Rp {{ number_format($item->total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-6 text-center text-gray-500 dark:text-gray-400">Belum ada data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @if(count($chartData) > 0)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('withdrawChart').getContext('2d');
            
            // Check current theme
            const isDarkMode = document.documentElement.classList.contains('dark');
            const textColor = isDarkMode ? '#e5e7eb' : '#374151';

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Jumlah Penukaran',
                        data: {!! json_encode($chartData) !!},
                        backgroundColor: [
                            '#108945', // Green
                            '#3b82f6', // Blue
                            '#eab308', // Yellow
                            '#ef4444', // Red
                            '#8b5cf6', // Purple
                            '#06b6d4', // Cyan
                        ],
                        borderWidth: 2,
                        borderColor: isDarkMode ? '#0a110d' : '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: textColor,
                                padding: 20,
                                font: {
                                    family: "'figtree', sans-serif",
                                    size: 12
                                }
                            }
                        }
                    },
                    cutout: '65%'
                }
            });
        });
    </script>
    @endif
</x-admin-layout>
