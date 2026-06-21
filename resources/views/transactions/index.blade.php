<x-app-layout>
    <div class="py-12">
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

            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-2">Trans<span class="text-emerald-600">aksi</span></h2>
                <p class="text-gray-600 dark:text-gray-400 text-base">Booking setoran sampahmu dari rumah, lalu bawa ke posko untuk ditimbang!</p>
            </div>

            @php
                $totalBeratWarga = $transactions->where('type', 'deposit')->whereIn('status', ['sukses', 'approved'])->sum('berat_kg');
                $co2Saved = $totalBeratWarga * 2.5; // Rumus standar: 1Kg Sampah = 2.5Kg Emisi
            @endphp
            @if($co2Saved > 0)
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl p-6 lg:p-8 shadow-lg text-white mb-10 relative overflow-hidden group">
                <svg class="absolute -right-6 -bottom-6 w-40 h-40 text-white/10 group-hover:scale-110 transition-transform duration-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"></path></svg>
                <div class="relative z-10">
                    <h3 class="text-emerald-100 text-sm font-bold uppercase tracking-wider mb-1 flex items-center gap-2">
                        <span>🌿</span> Eco-Impact Tracker
                    </h3>
                    <p class="text-3xl md:text-4xl font-black mb-2">
                        {{ number_format($co2Saved, 1, ',', '.') }} <span class="text-xl font-medium text-emerald-100">Kg CO₂</span>
                    </p>
                    <p class="text-emerald-50 text-sm md:text-base max-w-xl">
                        Luar biasa! Dari <strong>{{ floatval($totalBeratWarga) }} Kg</strong> sampah yang kamu setor, kamu telah membantu mencegah emisi gas rumah kaca sebesar {{ number_format($co2Saved, 1, ',', '.') }} Kg CO₂. Bumi berterima kasih padamu! 🌍
                    </p>
                </div>
            </div>
            @endif

            @php
                $activeTickets = $transactions->where('status', 'pending')->where('type', 'deposit');
            @endphp

            @if($activeTickets->count() > 0)
                <div class="mb-10">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                        🎟️ Tiket Antrean Aktif
                    </h3>
                    
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                        @foreach($activeTickets as $ticket)
                        <div class="relative flex flex-col md:flex-row bg-white dark:bg-gray-800 rounded-3xl shadow-lg hover:shadow-xl transition-shadow border border-gray-200 dark:border-gray-700 overflow-hidden group">
                            
                            <div class="p-6 md:p-8 flex-1 relative bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-850">
                                <div class="flex justify-between items-start mb-6">
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Kode Booking</p>
                                        <p class="text-lg font-mono font-bold text-gray-900 dark:text-white">{{ $ticket->trx_code ?? $ticket->reference_code }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 rounded-full text-xs font-bold uppercase animate-pulse border border-amber-200 dark:border-amber-800/50">Menunggu</span>
                                </div>

                                <div class="mb-6">
                                    <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-1">Kategori Sampah</p>
                                    <p class="text-xl md:text-2xl font-black text-emerald-600 dark:text-emerald-400">{{ $ticket->jenis_sampah }}</p>
                                </div>

                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700/50 p-3 rounded-xl border border-gray-200 dark:border-gray-600">
                                    <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p>Batas Waktu: 
                                        <strong class="text-gray-900 dark:text-white">
                                            {{ $ticket->expires_at ? \Carbon\Carbon::parse($ticket->expires_at)->format('H:i') : '12:00' }} WIB
                                        </strong> 
                                        ({{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y') }})
                                    </p>
                                </div>
                            </div>

                            <div class="hidden md:flex flex-col items-center justify-center relative w-8 border-l-2 border-dashed border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800">
                                <div class="absolute top-[-16px] w-8 h-8 bg-gray-50 dark:bg-[#0a110d] rounded-full border-b-2 border-dashed border-gray-300 dark:border-gray-600"></div>
                                <div class="absolute bottom-[-16px] w-8 h-8 bg-gray-50 dark:bg-[#0a110d] rounded-full border-t-2 border-dashed border-gray-300 dark:border-gray-600"></div>
                            </div>

                            <div class="p-6 md:w-56 bg-emerald-600 dark:bg-[#108945] text-white flex flex-col justify-center items-center relative overflow-hidden border-t-2 border-dashed border-gray-300 md:border-none">
                                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
                                <p class="text-sm font-bold text-emerald-200 uppercase tracking-widest mb-2 relative z-10">No. Antrean</p>
                                
                                @php
                                    $queueDisplay = '000';
                                    if ($ticket->queue_number) {
                                        $parts = explode('-', $ticket->queue_number);
                                        $queueDisplay = isset($parts[1]) ? $parts[1] : $ticket->queue_number;
                                    } else {
                                        // Fallback: Jika data lama belum punya antrean, gunakan 3 digit ID transaksi
                                        $queueDisplay = str_pad($ticket->id, 3, '0', STR_PAD_LEFT);
                                    }
                                @endphp

                                <p class="text-5xl lg:text-6xl font-black tracking-tight mb-4 relative z-10 drop-shadow-md">{{ $queueDisplay }}</p>
                                
                                <p class="text-xs text-emerald-100 text-center px-2 relative z-10 border-t border-emerald-500/50 pt-3">Tunjukkan layar ini kepada Admin Posko</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 lg:p-8 shadow-md border border-gray-100 dark:border-gray-700 mb-10">
                <h3 class="text-xl font-bold mb-6 text-gray-900 dark:text-white flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </div>
                    Buat Antrean Setor Baru
                </h3>

                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">Pilih Jenis Sampah (Bisa pilih lebih dari satu)</label>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            @foreach($wasteTypes as $type)
                            <label class="flex items-center p-3 border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 rounded-xl cursor-pointer hover:bg-emerald-50 dark:hover:bg-emerald-900/30 transition-colors group">
                                <input type="checkbox" name="waste_type_ids[]" value="{{ $type->id }}" class="w-5 h-5 text-emerald-600 bg-white border-gray-300 rounded focus:ring-emerald-500 dark:bg-gray-800 dark:border-gray-500">
                                <div class="ml-3">
                                    <span class="block text-sm font-bold text-gray-900 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-emerald-400">{{ $type->name }}</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">Estimasi: Rp {{ number_format($type->price_per_kg, 0, ',', '.') }}/Kg</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        
                        @error('waste_type_ids')
                            <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="w-full bg-emerald-600 text-white font-bold px-6 py-3 rounded-xl hover:bg-emerald-700 transition flex justify-center items-center gap-2 shadow-lg shadow-emerald-500/30">
                        <span>Buat Booking Multi-Item</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 gap-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 lg:p-8 shadow-md border border-gray-100 dark:border-gray-700">
                    <h3 class="text-xl font-bold mb-6 text-gray-900 dark:text-white flex items-center gap-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Riwayat Setoran Saya
                    </h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase">Tanggal</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase">Kode Booking</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase">Sampah</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase">Berat Riil</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase">Pendapatan</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($transactions->where('type', 'deposit') as $trx)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-4">
                                        <span class="font-mono font-bold bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-300 px-2 py-1 rounded">{{ $trx->trx_code ?? $trx->reference_code }}</span>
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $trx->jenis_sampah }}</td>
                                    <td class="px-4 py-4 text-sm font-medium {{ $trx->berat_kg ? 'text-gray-800 dark:text-gray-200' : 'text-amber-500 italic' }}">
                                        {{ $trx->berat_kg ? floatval($trx->berat_kg) . ' Kg' : 'Menunggu Admin' }}
                                    </td>
                                    <td class="px-4 py-4 text-sm font-bold text-emerald-600 dark:text-emerald-400">
                                        {{ $trx->total_harga ? '+ Rp ' . number_format($trx->total_harga, 0, ',', '.') : '-' }}
                                    </td>
                                    <td class="px-4 py-4">
                                        @if($trx->status === 'pending')
                                            @if($trx->created_at->diffInHours(now()) > 24)
                                                <span class="px-2.5 py-1 rounded text-xs font-bold uppercase tracking-wider bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400 dark:border dark:border-red-500/30 line-through">Kadaluarsa</span>
                                            @else
                                                <span class="px-2.5 py-1 rounded text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400 dark:border dark:border-amber-500/30">Menunggu</span>
                                            @endif
                                        @elseif($trx->status === 'sukses' || $trx->status === 'approved')
                                            <span class="px-2.5 py-1 rounded text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400 dark:border dark:border-emerald-500/30">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-sm text-gray-500 bg-gray-50 dark:bg-gray-800/50 rounded-b-lg">Belum ada riwayat setor sampah.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 lg:p-8 shadow-md border border-gray-100 dark:border-gray-700">
                    <h3 class="text-xl font-bold mb-6 text-gray-900 dark:text-white flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Riwayat Penukaran & Tarik Tunai
                    </h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase">Tanggal</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase">Barang / Bank</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase">PIN OTP</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase">Nominal</th>
                                    <th class="px-4 py-3 font-semibold text-gray-600 dark:text-gray-300 text-xs uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($transactions->whereIn('type', ['withdrawal', 'redemption']) as $trx)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $trx->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-800 dark:text-gray-200">{{ $trx->jenis_sampah }}</td>
                                    <td class="px-4 py-4">
                                        @if($trx->otp_code && $trx->status == 'hold')
                                            <span class="font-mono text-lg font-black tracking-widest text-blue-600 bg-blue-50 dark:bg-blue-900/30 dark:text-blue-400 px-3 py-1 rounded-md border border-blue-200 dark:border-blue-800/50">{{ $trx->otp_code }}</span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm font-bold text-red-500 dark:text-red-400">- Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-4 py-4">
                                        @if($trx->status === 'hold')
                                            <span class="px-2.5 py-1 rounded text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400">Tunjukkan OTP</span>
                                        @elseif($trx->status === 'sukses' && $trx->type === 'withdrawal')
                                            <div class="flex flex-col gap-1 items-start">
                                                <span class="px-2.5 py-1 rounded text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400">Selesai</span>
                                                @if($trx->otp_code)
                                                    <a href="{{ asset($trx->otp_code) }}" target="_blank" class="text-[11px] text-blue-500 hover:text-blue-400 hover:underline flex items-center gap-1 mt-1">
                                                        👁️ Lihat Bukti Transfer
                                                    </a>
                                                @endif
                                            </div>
                                        @elseif($trx->status === 'sukses')
                                            <span class="px-2.5 py-1 rounded text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400">Selesai</span>
                                        @else
                                            <span class="px-2.5 py-1 rounded text-xs font-bold uppercase tracking-wider bg-gray-100 text-gray-800 dark:bg-gray-700/50 dark:text-gray-400">{{ $trx->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-sm text-gray-500 bg-gray-50 dark:bg-gray-800/50 rounded-b-lg">Belum ada riwayat penarikan / penukaran.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>