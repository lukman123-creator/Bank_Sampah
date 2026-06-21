<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Kelola Transaksi Warga</h1>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-8">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-emerald-50 dark:bg-emerald-900/10">
            <h2 class="text-lg font-bold text-emerald-800 dark:text-emerald-400">Antrean Setoran Sampah (Butuh Timbang)</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-gray-500 text-xs uppercase">Tanggal & Kode</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 text-xs uppercase">Nasabah</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 text-xs uppercase">Jenis Sampah</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 text-xs uppercase">Aksi Admin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($transactions->where('type', 'deposit')->where('status', 'pending') as $trx)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4">
                            <div class="text-xs text-gray-500">{{ $trx->created_at->format('d/m/Y H:i') }}</div>
                            <div class="font-mono font-bold text-gray-800 dark:text-white">{{ $trx->trx_code ?? $trx->reference_code }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">{{ $trx->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">{{ $trx->jenis_sampah }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.transactions.approve_deposit', $trx->id) }}" method="POST" class="flex gap-2 items-center">
                                @csrf
                                <input type="number" step="0.1" name="berat_kg" placeholder="0.0 Kg" class="w-24 text-sm border-gray-300 rounded px-2 py-1" required>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-3 py-1.5 rounded">Timbang</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">Tidak ada antrean setoran warga saat ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-8">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-blue-50 dark:bg-blue-900/10">
            <h2 class="text-lg font-bold text-blue-800 dark:text-blue-400">Antrean Klaim Hadiah & Tarik Tunai</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-3 font-semibold text-gray-500 text-xs uppercase">Tanggal & Kode</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 text-xs uppercase">Nasabah</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 text-xs uppercase">Permintaan</th>
                        <th class="px-6 py-3 font-semibold text-gray-500 text-xs uppercase">Aksi Admin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($transactions->whereIn('type', ['withdrawal', 'redemption'])->whereIn('status', ['pending', 'hold']) as $trx)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <td class="px-6 py-4">
                            <div class="text-xs text-gray-500">{{ $trx->created_at->format('d/m/Y H:i') }}</div>
                            <div class="font-mono font-bold text-gray-800 dark:text-white">{{ $trx->trx_code ?? $trx->reference_code }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">{{ $trx->user->name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold">{{ $trx->jenis_sampah }}</div>
                            <div class="text-xs text-red-500">- Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            
                            @if($trx->type === 'redemption' && $trx->status === 'hold')
                                <form action="{{ route('admin.transactions.approve_redeem', $trx->id) }}" method="POST" class="flex gap-2 items-center">
                                    @csrf
                                    <input type="text" name="otp_code" placeholder="PIN OTP" class="w-24 text-sm border-gray-300 rounded px-2 py-1 uppercase" required>
                                    <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold px-3 py-1.5 rounded">Cek OTP</button>
                                </form>

                            @elseif($trx->type === 'withdrawal' && $trx->status === 'pending')
                                <div class="flex items-start gap-3">
                                    <form action="{{ route('admin.transactions.approve-withdrawal', $trx->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-1">
                                        @csrf
                                        <input type="file" name="bukti_transfer" class="text-xs w-48" required>
                                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-3 py-1.5 rounded text-center">Kirim Bukti & Approve</button>
                                    </form>
                                    <form action="{{ route('admin.transactions.reject-withdrawal', $trx->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded mt-6">Tolak</button>
                                    </form>
                                </div>
                            @endif

                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">Tidak ada permintaan klaim atau tarik tunai.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>