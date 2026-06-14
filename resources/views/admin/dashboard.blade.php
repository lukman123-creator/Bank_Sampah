<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 dark:text-green-300 leading-tight">
            {{ __('Dashboard Admin Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/40 dark:bg-gray-800/40 backdrop-blur-md border border-white/20 dark:border-gray-700/50 shadow-xl overflow-hidden sm:rounded-2xl transition-colors duration-300">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-3xl font-bold mb-6 text-green-700 dark:text-green-400">Verifikasi Setoran Sampah</h3>
                    
                    @if(session('success'))
                        <div class="bg-green-100/80 dark:bg-green-900/50 backdrop-blur-sm border border-green-400/50 dark:border-green-600/50 text-green-800 dark:text-green-200 px-6 py-4 rounded-xl mb-8 shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="bg-white/50 dark:bg-gray-800/50 backdrop-blur-md rounded-2xl p-6 border border-white/30 dark:border-gray-700/50 shadow-lg">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-green-600/10 dark:bg-green-500/10 text-green-800 dark:text-green-300 rounded-t-xl">
                                        <th class="p-4 font-semibold border-b border-green-200/50 dark:border-green-800/50">Tanggal</th>
                                        <th class="p-4 font-semibold border-b border-green-200/50 dark:border-green-800/50">Nama User</th>
                                        <th class="p-4 font-semibold border-b border-green-200/50 dark:border-green-800/50">Jenis Sampah</th>
                                        <th class="p-4 font-semibold border-b border-green-200/50 dark:border-green-800/50">Berat (Kg)</th>
                                        <th class="p-4 font-semibold border-b border-green-200/50 dark:border-green-800/50">Total Harga</th>
                                        <th class="p-4 font-semibold border-b border-green-200/50 dark:border-green-800/50 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions ?? [] as $trx)
                                    <tr class="border-b border-gray-200/50 dark:border-gray-700/50 hover:bg-green-50/50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="p-4">{{ $trx->created_at->format('d M Y H:i') }}</td>
                                        <td class="p-4 font-medium">{{ $trx->user->name }}</td>
                                        <td class="p-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                                {{ $trx->jenis_sampah }}
                                            </span>
                                        </td>
                                        <td class="p-4">{{ $trx->berat_kg }}</td>
                                        <td class="p-4 font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                        <td class="p-4 text-center">
                                            @if($trx->status === 'pending' && $trx->type === 'deposit')
                                                <form action="{{ route('admin.transactions.approve', $trx->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white font-bold py-1.5 px-4 rounded-lg shadow hover:shadow-md transition-all text-sm">
                                                        Approve
                                                    </button>
                                                </form>
                                            @else
                                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                                                    {{ $trx->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                                    {{ $trx->status }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="p-8 text-center text-gray-500 dark:text-gray-400 italic">Belum ada transaksi yang perlu diverifikasi.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>