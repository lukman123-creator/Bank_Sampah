<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 dark:text-green-300 leading-tight">
            {{ __('Dashboard User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/40 dark:bg-gray-800/40 backdrop-blur-md border border-white/20 dark:border-gray-700/50 shadow-xl overflow-hidden sm:rounded-2xl transition-colors duration-300">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-3xl font-bold mb-6 text-green-700 dark:text-green-400">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        <div class="bg-green-100/50 dark:bg-green-900/30 backdrop-blur-sm border border-green-200 dark:border-green-800/50 p-8 rounded-2xl shadow-lg transition-transform hover:-translate-y-1 duration-300">
                            <h4 class="text-lg font-semibold text-green-800 dark:text-green-300 mb-2">Total Sampah Disetor</h4>
                            <p class="text-4xl font-extrabold text-green-600 dark:text-green-400">{{ $total_berat ?? 0 }} <span class="text-2xl font-medium">Kg</span></p>
                        </div>
                        <div class="bg-emerald-100/50 dark:bg-emerald-900/30 backdrop-blur-sm border border-emerald-200 dark:border-emerald-800/50 p-8 rounded-2xl shadow-lg transition-transform hover:-translate-y-1 duration-300">
                            <h4 class="text-lg font-semibold text-emerald-800 dark:text-emerald-300 mb-2">Saldo Dompet (Rp)</h4>
                            <p class="text-4xl font-extrabold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($total_saldo ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="bg-white/50 dark:bg-gray-800/50 backdrop-blur-md rounded-2xl p-6 border border-white/30 dark:border-gray-700/50 shadow-lg">
                        <h4 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">5 Transaksi Terakhir</h4>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-green-600/10 dark:bg-green-500/10 text-green-800 dark:text-green-300 rounded-t-xl">
                                        <th class="p-4 font-semibold border-b border-green-200/50 dark:border-green-800/50">Tanggal</th>
                                        <th class="p-4 font-semibold border-b border-green-200/50 dark:border-green-800/50">Jenis</th>
                                        <th class="p-4 font-semibold border-b border-green-200/50 dark:border-green-800/50">Tipe</th>
                                        <th class="p-4 font-semibold border-b border-green-200/50 dark:border-green-800/50">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recent_transactions ?? [] as $trx)
                                    <tr class="border-b border-gray-200/50 dark:border-gray-700/50 hover:bg-green-50/50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="p-4">{{ $trx->created_at->format('d M Y') }}</td>
                                        <td class="p-4">{{ $trx->jenis_sampah }}</td>
                                        <td class="p-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $trx->type === 'deposit' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300' : 'bg-orange-100 text-orange-800 dark:bg-orange-900/50 dark:text-orange-300' }}">
                                                {{ ucfirst($trx->type) }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold 
                                                {{ $trx->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300' : '' }}
                                                {{ $trx->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300' : '' }}
                                                {{ $trx->status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300' : '' }}
                                            ">
                                                {{ ucfirst($trx->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="p-8 text-center text-gray-500 dark:text-gray-400 italic">Belum ada transaksi. Ayo mulai setor sampah!</td>
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