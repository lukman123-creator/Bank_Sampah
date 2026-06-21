<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Penjualan ke Pengepul</h1>
        <button onclick="openModal('saleModal')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2.5 rounded-xl text-sm transition shadow-md flex items-center gap-2">
            🏭 Catat Penjualan Baru
        </button>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded shadow-sm mb-6 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm mb-6 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            <span class="font-medium text-sm">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-sm font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Log Aktivitas Penjualan Outbound</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Nama Pengepul</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Jenis Sampah</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Berat (Kg)</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Harga / Kg</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Total Penjualan</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wider">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($sales as $sale)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($sale->sold_at)->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white">
                            {{ $sale->collector_name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                            {{ $sale->wasteType->name ?? 'Dihapus' }}
                        </td>
                        <td class="px-6 py-4 text-sm font-mono text-gray-700 dark:text-gray-300">
                            {{ floatval($sale->weight_kg) }} kg
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                            Rp {{ number_format($sale->price_per_kg, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-emerald-600">
                            Rp {{ number_format($sale->total_sale, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-400 max-w-xs truncate" title="{{ $sale->notes }}">
                            {{ $sale->notes ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-sm text-gray-500">
                            Belum ada rekam jejak penjualan sampah ke pengepul besar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="saleModal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center" x-data="{ 
        berat: 0, 
        harga: 0, 
        maxStock: 0,
        updateMaxStock(e) {
            this.maxStock = parseFloat(e.target.selectedOptions[0].getAttribute('data-stock') || 0);
        }
    }">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg w-full max-w-sm mx-4 overflow-hidden border border-gray-100 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Form Penjualan Pengepul</h3>
            </div>
            
            <form action="{{ route('admin.transactions.sell-to-collector') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1.5">Nama Pengepul</label>
                    <input type="text" name="collector_name" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-2 px-3 text-sm" placeholder="Contoh: CV Maju Jaya">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1.5">Pilih Jenis Sampah</label>
                    <select name="waste_type_id" required @change="updateMaxStock($event)" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-2 px-3 text-sm">
                        <option value="" data-stock="0">-- Pilih Barang --</option>
                        @foreach(\App\Models\WasteType::all() as $type)
                            @php
                                $stockModel = \App\Models\WasteStock::where('waste_type_id', $type->id)->first();
                                $currentStock = $stockModel ? $stockModel->available_kg : 0;
                            @endphp
                            <option value="{{ $type->id }}" data-stock="{{ $currentStock }}">{{ $type->name }} (Stok: {{ floatval($currentStock) }} kg)</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Berat Dijual (Kg)</label>
                        <span class="text-[11px] text-gray-500 font-medium">Batas Maks: <span x-text="maxStock">0</span> kg</span>
                    </div>
                    <input type="number" step="0.01" name="weight_kg" x-model.number="berat" :max="maxStock" required min="0.1" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-2 px-3 text-sm">
                    <p x-show="berat > maxStock" class="text-xs text-red-500 mt-1" style="display: none;">⚠️ Stok sampah tidak mencukupi.</p>
                </div>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1.5">Harga Jual per Kg (Rp)</label>
                    <input type="number" name="price_per_kg" x-model.number="harga" required min="0" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-2 px-3 text-sm" placeholder="Harga kesepakatan">
                </div>

                <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg flex justify-between items-center text-sm font-medium">
                    <span class="text-gray-500 dark:text-gray-400">Total Pendapatan (FR-03):</span>
                    <span class="text-emerald-600 dark:text-emerald-400 font-bold text-base">
                        Rp <span x-text="new Intl.NumberFormat('id-ID').format(berat * harga)">0</span>
                    </span>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1.5">Catatan (Opsional)</label>
                    <textarea name="notes" rows="2" class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white py-2 px-3 text-sm" placeholder="Keterangan tambahan..."></textarea>
                </div>

                <div class="pt-2 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('saleModal')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold rounded-lg transition">Batal</button>
                    <button type="submit" :disabled="berat > maxStock || berat <= 0" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
</x-admin-layout>