<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Transaksi Bank Sampah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Setor Sampah Baru</h3>
                    <form action="{{ route('transactions.store') }}" method="POST" class="flex flex-col sm:flex-row gap-4 items-end">
                        @csrf
                        <div class="w-full sm:w-1/3">
                            <label class="block text-sm font-medium text-gray-700">Jenis Sampah</label>
                            <select name="jenis_sampah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                <option value="Plastik">Plastik</option>
                                <option value="Kertas">Kertas</option>
                                <option value="Logam">Logam/Besi</option>
                            </select>
                        </div>
                        <div class="w-full sm:w-1/3">
                            <label class="block text-sm font-medium text-gray-700">Berat (Kg)</label>
                            <input type="number" step="0.1" name="berat_kg" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                        </div>
                        <div class="w-full sm:w-auto">
                            <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">Simpan Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <h3 class="text-lg font-bold mb-4">Riwayat Setoran</h3>
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="py-3 px-4 font-semibold text-sm">Tanggal</th>
                                <th class="py-3 px-4 font-semibold text-sm">Jenis Sampah</th>
                                <th class="py-3 px-4 font-semibold text-sm">Berat</th>
                                <th class="py-3 px-4 font-semibold text-sm">Pendapatan</th>
                                <th class="py-3 px-4 font-semibold text-sm">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $trx)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm">{{ $trx->created_at->format('d M Y') }}</td>
                                <td class="py-3 px-4 text-sm">{{ $trx->jenis_sampah }}</td>
                                <td class="py-3 px-4 text-sm">{{ floatval($trx->berat_kg) }} Kg</td>
                                <td class="py-3 px-4 text-sm font-bold text-green-600">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-sm">
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">{{ $trx->status }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-4 px-4 text-center text-gray-500 text-sm">Belum ada riwayat transaksi. Ayo setor sampah pertamamu!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
