<x-app-layout>
    <div class="py-12" x-data="{ 
            showModal: false, 
            selectedReward: null,
            showWithdraw: false
        }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">

            @if(session('success'))
                <div class="bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 text-green-700 dark:text-green-400 px-6 py-4 rounded-2xl mb-8 shadow-[0_0_15px_rgba(34,197,94,0.1)] flex items-center gap-3 animate-slideUp transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-600 dark:text-red-400 px-6 py-4 rounded-2xl mb-8 shadow-[0_0_15px_rgba(239,68,68,0.1)] flex items-center gap-3 animate-slideUp transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Header Section -->
            <div class="mb-10 animate-slideUp flex flex-col md:flex-row md:items-center justify-between gap-4" style="animation-delay: 0.1s;">
                <div>
                    <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-2 transition-colors">Katalog <span class="text-green-600 dark:text-green-500">Hadiah</span></h2>
                    <p class="text-gray-600 dark:text-gray-400 font-medium text-lg transition-colors">Tukarkan saldo dompetmu dengan berbagai hadiah menarik atau tarik tunai.</p>
                </div>
                <div>
                    <button @click="showWithdraw = true" class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-6 py-3 rounded-xl font-bold hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors shadow-lg flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Tarik Tunai Bank
                    </button>
                </div>
            </div>

            <!-- Saldo Card -->
            <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 overflow-hidden shadow-2xl rounded-[2.5rem] mb-10 p-8 lg:p-10 relative group hover:-translate-y-1 transition-all duration-300 animate-slideUp" style="animation-delay: 0.2s;">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-green-500/5 dark:bg-green-500/10 rounded-full mix-blend-overlay filter blur-3xl opacity-50 group-hover:scale-110 transition-transform duration-700"></div>
                <h3 class="text-gray-500 dark:text-gray-400 text-sm uppercase font-bold tracking-wider mb-2 relative z-10 transition-colors">Saldo Tersedia Kamu</h3>
                <p class="text-5xl font-black text-gray-900 dark:text-white relative z-10 transition-colors" x-data="numberCounter({{ $saldo }}, true)"><span class="text-2xl text-gray-400 dark:text-gray-500 mr-2">Rp</span><span x-text="formatted()"></span></p>
            </div>

            <!-- Katalog Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($rewards ?? [] as $index => $reward)
                    <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 p-8 rounded-[2rem] shadow-xl hover:-translate-y-2 transition-all duration-300 animate-slideUp group" style="animation-delay: {{ 0.3 + ($index * 0.1) }}s;">
                        <div class="w-16 h-16 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl flex items-center justify-center mb-6 text-3xl group-hover:scale-110 transition-all">
                            {{ $reward->icon ?: '🎁' }}
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-2 transition-colors">{{ $reward->name }}</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 h-10 overflow-hidden">{{ $reward->description }}</p>
                        <p class="text-gray-600 dark:text-gray-400 mb-6 font-medium transition-colors">Harga: <span class="text-green-600 dark:text-green-400 font-bold transition-colors">Rp {{ number_format($reward->price, 0, ',', '.') }}</span></p>
                        
                        <button type="button" @click="selectedReward = {{ json_encode($reward) }}; showModal = true" class="w-full bg-[#108945] hover:bg-[#0c6b35] text-white font-bold py-3 px-4 rounded-xl shadow-[0_0_15px_rgba(16,137,69,0.3)] transition-all border border-transparent">
                            Tukar Sekarang
                        </button>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-gray-500 dark:text-gray-400">
                        Belum ada hadiah di katalog.
                    </div>
                @endforelse
            </div>

        </div>

        <!-- Reward Modal Popup -->
        <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-gray-900/70 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="showModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white dark:bg-[#0a110d] border border-gray-200 dark:border-white/10 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full p-8">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white" id="modal-title">Konfirmasi Penukaran</h3>
                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    <div class="mt-2 text-center">
                        <div class="w-20 h-20 bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-full flex items-center justify-center text-4xl mx-auto mb-4" x-text="selectedReward?.icon || '🎁'"></div>
                        <p class="text-lg text-gray-500 dark:text-gray-400 mb-1">Kamu akan menukar saldo dengan</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mb-2" x-text="selectedReward?.name"></p>
                        <p class="text-green-600 dark:text-green-400 font-bold text-xl mb-6">Harga: Rp <span x-text="new Intl.NumberFormat('id-ID').format(selectedReward?.price)"></span></p>
                    </div>
                    <form action="{{ route('katalog.tukar') }}" method="POST" class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                        @csrf
                        <input type="hidden" name="reward_id" :value="selectedReward?.id">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-3 bg-[#108945] hover:bg-[#0c6b35] text-base font-medium text-white sm:col-start-2 sm:text-sm transition-colors">
                            Ya, Tukar Sekarang
                        </button>
                        <button type="button" @click="showModal = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-3 bg-white dark:bg-white/5 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/10 sm:mt-0 sm:col-start-1 sm:text-sm transition-colors">
                            Batal
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Withdraw Bank Modal Popup -->
        <div x-show="showWithdraw" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showWithdraw" x-transition.opacity class="fixed inset-0 bg-gray-900/70 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="showWithdraw = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="showWithdraw" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white dark:bg-[#0a110d] border border-gray-200 dark:border-white/10 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full p-8">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white" id="modal-title">Tarik Tunai Bank</h3>
                        <button @click="showWithdraw = false" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    
                    <form action="{{ route('katalog.withdraw') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Bank</label>
                            <select name="bank_name" required class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0a110d] text-gray-900 dark:text-white focus:border-green-500 focus:ring-green-500 py-3">
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
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nomor Rekening / E-Wallet</label>
                            <input type="text" name="account_number" required class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0a110d] text-gray-900 dark:text-white focus:border-green-500 focus:ring-green-500 py-3" placeholder="Contoh: 08123456789">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nominal Penarikan (Min Rp 10.000)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-400">Rp</span>
                                </div>
                                <input type="number" name="amount" min="10000" required class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0a110d] text-gray-900 dark:text-white focus:border-green-500 focus:ring-green-500 pl-10 py-3" placeholder="50000">
                            </div>
                        </div>

                        <div class="pt-4 flex gap-3">
                            <button type="button" @click="showWithdraw = false" class="w-1/3 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-white/5 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/10 transition-colors font-medium">Batal</button>
                            <button type="submit" class="w-2/3 py-3 rounded-xl bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors font-bold shadow-lg">Proses Tarik Tunai</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
