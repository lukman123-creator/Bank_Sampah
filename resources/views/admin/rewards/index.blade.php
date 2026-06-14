<x-admin-layout>
    <div class="py-12" x-data="{ showModal: false, isEdit: false, reward: { id: '', name: '', price: '', icon: '', description: '' } }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Katalog <span class="text-green-600 dark:text-green-500">Rewards</span></h2>
                    <p class="text-gray-600 dark:text-gray-400 font-medium">Kelola daftar hadiah yang bisa ditukarkan oleh user.</p>
                </div>
                <button @click="isEdit = false; reward = { id: '', name: '', price: '', icon: '', description: '' }; showModal = true" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 px-6 rounded-xl transition-colors shadow-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Reward
                </button>
            </div>

            @if(session('success'))
                <div class="bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 text-green-700 dark:text-green-400 px-6 py-4 rounded-2xl mb-8 shadow-sm flex items-center gap-3 animate-slideUp transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Table -->
            <div class="bg-white/80 dark:bg-[#0a110d]/60 backdrop-blur-xl border border-gray-200 dark:border-white/10 overflow-hidden shadow-2xl rounded-[2rem] transition-colors duration-300">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-white/5 border-b border-gray-200 dark:border-white/5 transition-colors">
                                <th class="py-4 px-6 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Icon</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Hadiah</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Harga</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Deskripsi</th>
                                <th class="py-4 px-6 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-white/5 transition-colors">
                            @forelse($rewards as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                                    <td class="py-4 px-6 text-2xl">{{ $item->icon ?: '🎁' }}</td>
                                    <td class="py-4 px-6 font-bold text-gray-900 dark:text-white">{{ $item->name }}</td>
                                    <td class="py-4 px-6 text-green-600 dark:text-green-400 font-bold">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="py-4 px-6 text-gray-600 dark:text-gray-400 text-sm max-w-xs truncate">{{ $item->description }}</td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button @click="isEdit = true; reward = {{ json_encode($item) }}; showModal = true" class="p-2 text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded-lg transition-colors" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </button>
                                            <form action="{{ route('admin.rewards.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus hadiah ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition-colors" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-500 dark:text-gray-400">Belum ada data reward.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Form -->
            <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-gray-900/70 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="showModal = false"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    
                    <div x-show="showModal" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white dark:bg-[#0a110d] border border-gray-200 dark:border-white/10 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full p-8">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white" id="modal-title" x-text="isEdit ? 'Edit Reward' : 'Tambah Reward'"></h3>
                            <button @click="showModal = false" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                        
                        <form :action="isEdit ? '/admin/rewards/' + reward.id : '{{ route('admin.rewards.store') }}'" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Hadiah</label>
                                <input type="text" name="name" x-model="reward.name" required class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0a110d] text-gray-900 dark:text-white focus:border-green-500 focus:ring-green-500 py-3">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga (Saldo)</label>
                                <input type="number" name="price" x-model="reward.price" min="0" required class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0a110d] text-gray-900 dark:text-white focus:border-green-500 focus:ring-green-500 py-3">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Icon (Emoji)</label>
                                <input type="text" name="icon" x-model="reward.icon" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0a110d] text-gray-900 dark:text-white focus:border-green-500 focus:ring-green-500 py-3" placeholder="📱">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                                <textarea name="description" x-model="reward.description" rows="3" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0a110d] text-gray-900 dark:text-white focus:border-green-500 focus:ring-green-500 py-3"></textarea>
                            </div>

                            <div class="pt-4 flex gap-3">
                                <button type="button" @click="showModal = false" class="w-1/3 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-white/5 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/10 transition-colors font-medium">Batal</button>
                                <button type="submit" class="w-2/3 py-3 rounded-xl bg-green-600 text-white hover:bg-green-700 transition-colors font-bold shadow-lg" x-text="isEdit ? 'Simpan Perubahan' : 'Simpan'"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
