<x-app-layout>
    <div class="py-12" x-data="{ 
            showModal: false, 
            selectedReward: null,
            showWithdraw: false,
            selectedBank: 'BCA'
        }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-lg shadow-sm mb-8 flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm mb-8 flex items-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium text-sm">{{ session('error') }}</span>
                </div>
            @endif

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-2">Katalog <span class="text-emerald-600">Hadiah</span></h2>
                    <p class="text-gray-600 dark:text-gray-400 text-base">Tukarkan saldo dompetmu dengan barang fisik atau tarik tunai ke rekening.</p>
                </div>
                <div>
                    <button @click="showWithdraw = true" class="bg-gray-800 dark:bg-gray-100 text-white dark:text-gray-900 px-5 py-2.5 rounded-lg font-bold hover:bg-gray-700 dark:hover:bg-white transition-colors shadow-sm flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Tarik Tunai Bank
                    </button>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm rounded-2xl mb-10 p-6 lg:p-8">
                <h3 class="text-gray-500 dark:text-gray-400 text-xs uppercase font-bold tracking-wider mb-2">Total Saldo Tersedia</h3>
                <p class="text-4xl font-black text-emerald-600 dark:text-emerald-400" x-data="numberCounter({{ $saldo }}, true)">
                    <span class="text-2xl text-gray-400 dark:text-gray-500 mr-1">Rp</span><span x-text="formatted()"></span>
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($rewards ?? [] as $reward)
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow relative flex flex-col">
                        
                        <div class="absolute top-4 right-4 bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded dark:bg-blue-900/30 dark:text-blue-300">
                            Sisa Stok: {{ $reward->stock }}
                        </div>

                        <div class="w-14 h-14 bg-gray-50 dark:bg-gray-700 border border-gray-100 dark:border-gray-600 rounded-lg flex items-center justify-center mb-4 text-2xl">
                            {{ $reward->icon ?: '🎁' }}
                        </div>
                        
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $reward->name }}</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 flex-grow">{{ $reward->description }}</p>
                        
                        <div class="pt-4 border-t border-gray-100 dark:border-gray-700 mb-4">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wider font-bold">Harga Penukaran</p>
                            <p class="text-lg text-emerald-600 dark:text-emerald-400 font-bold">Rp {{ number_format($reward->price, 0, ',', '.') }}</p>
                        </div>
                        
                        <button type="button" @click="selectedReward = {{ json_encode($reward) }}; showModal = true" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 px-4 rounded-lg transition-colors text-sm">
                            Pilih Hadiah
                        </button>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada barang fisik di katalog saat ini.</p>
                    </div>
                @endforelse
            </div>

        </div>

        <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true" @click="showModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                
                <div x-show="showModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white" id="modal-title">Konfirmasi Reservasi</h3>
                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-6 bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg">
                            <div class="w-12 h-12 bg-white dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded flex items-center justify-center text-2xl" x-text="selectedReward?.icon || '🎁'"></div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Item yang ditukar:</p>
                                <p class="text-lg font-bold text-gray-900 dark:text-white" x-text="selectedReward?.name"></p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mb-6">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Potongan Saldo:</p>
                            <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400">Rp <span x-text="new Intl.NumberFormat('id-ID').format(selectedReward?.price)"></span></p>
                        </div>

                        <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 p-3 mb-6 text-sm text-blue-800 dark:text-blue-300">
                            <strong>Info Penting:</strong> Setelah klik tukar, kamu akan mendapatkan 6 digit PIN OTP. Tunjukkan PIN tersebut ke petugas posko untuk mengambil barangmu.
                        </div>

                        <form action="{{ route('katalog.tukar') }}" method="POST" class="flex gap-3">
                            @csrf
                            <input type="hidden" name="reward_id" :value="selectedReward?.id">
                            <button type="button" @click="showModal = false" class="w-1/2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                                Batal
                            </button>
                            <button type="submit" class="w-1/2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700 transition">
                                Ya, Tukar Saldo
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="showWithdraw" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showWithdraw" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true" @click="showWithdraw = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                
                <div x-show="showWithdraw" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white" id="modal-title">Tarik Tunai Saldo</h3>
                        <button @click="showWithdraw = false" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    
                    <form action="{{ route('katalog.withdraw') }}" method="POST" class="p-6 space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nama Bank / E-Wallet</label>
                            <select name="bank_name" x-model="selectedBank" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 py-2.5 text-sm">
                                <option value="BCA">BCA</option>
                                <option value="Mandiri">Mandiri</option>
                                <option value="BNI">BNI</option>
                                <option value="BRI">BRI</option>
                                <option value="BSI">BSI</option>
                                <option value="GoPay">GoPay</option>
                                <option value="OVO">OVO</option>
                                <option value="Dana">Dana</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2" 
                                   x-text="['Dana', 'GoPay', 'OVO'].includes(selectedBank) ? 'Nomor HP Terdaftar' : 'Nomor Rekening'"></label>
                            
                            <input type="text" name="account_number" required 
                                   :placeholder="['Dana', 'GoPay', 'OVO'].includes(selectedBank) ? 'Contoh: 08123456789' : 'Contoh: 1234567890'"
                                   class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 py-2.5 text-sm">
                                   
                            <p class="text-[11px] mt-1.5 text-gray-500 dark:text-gray-400">
                                <span x-show="!['Dana', 'GoPay', 'OVO'].includes(selectedBank)">ℹ️ Pastikan nomor rekening <span x-text="selectedBank" class="font-bold"></span> valid.</span>
                                <span x-show="['Dana', 'GoPay', 'OVO'].includes(selectedBank)" style="display: none;">ℹ️ Pastikan diawali "08" dan terdaftar di <span x-text="selectedBank" class="font-bold"></span>.</span>
                            </p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nominal (Min. Rp 10.000)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">Rp</span>
                                </div>
                                <input type="number" name="amount" min="10000" max="{{ Auth::user()->balance ?? 0 }}" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 pl-10 py-2.5 text-sm font-bold" placeholder="50000">
                            </div>
                            <p class="text-[11px] mt-1.5 text-gray-500 dark:text-gray-400">Maksimal penarikan: Rp {{ number_format(Auth::user()->balance ?? 0, 0, ',', '.') }}</p>
                        </div>

                        <div class="pt-2 flex gap-3">
                            <button type="button" @click="showWithdraw = false" class="w-1/3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition">Batal</button>
                            <button type="submit" class="w-2/3 rounded-lg bg-gray-800 dark:bg-gray-100 text-white dark:text-gray-900 px-4 py-2.5 text-sm font-bold hover:bg-gray-700 dark:hover:bg-white transition">Proses Tarik Tunai</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>