<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Kelola Stok Gudang (FR-02)</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
            <h2 class="text-sm font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Status Inventori Riil</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Nama Sampah</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Harga Beli Warga (per Kg)</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Total Stok Tersedia</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Tanggal Update</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($stocks as $stock)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white flex items-center gap-2">
                            <span class="text-lg">{{ $stock->wasteType->icon ?? '♻️' }}</span>
                            {{ $stock->wasteType->name }}
                        </td>
                        <td class="px-6 py-4 font-mono text-xs text-gray-600 dark:text-gray-400">
                            {{ $stock->wasteType->code ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                            Rp {{ number_format($stock->wasteType->price_per_kg, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 rounded-full font-bold text-xs {{ $stock->available_kg > 50 ? 'bg-emerald-100 text-emerald-800' : ($stock->available_kg > 0 ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-500') }}">
                                {{ floatval($stock->available_kg) }} Kg
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $stock->updated_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">
                            Gudang masih kosong. Belum ada transaksi setoran warga yang di-approve untuk mengisi stok.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>