<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\WasteType;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->with(['wasteType', 'reward'])->latest()->get();
        $wasteTypes = WasteType::all();
        $rewards = Reward::where('stock', '>', 0)->get();

        return view('transactions.index', compact('transactions', 'wasteTypes', 'rewards'));
    }

    public function store(Request $request)
    {
        // Validasi wajib pilih minimal 1 jenis sampah
        $request->validate([
            'waste_type_ids' => 'required|array|min:1',
            'waste_type_ids.*' => 'exists:waste_types,id',
        ], [
            'waste_type_ids.required' => 'Pilih minimal satu jenis sampah yang akan disetor!'
        ]);

        // Generate Base Kode Booking & Nomor Antrean (Dibuat di luar loop biar 1 grup)
        $baseBookingCode = 'BK-' . date('ymd') . '-' . strtoupper(Str::random(4));
        $queueNumber = 'Q-' . strtoupper(Str::random(3)) . '-' . date('d');
        $expiresAt = now()->addHours(2); // Hangus dalam 2 jam

        // Looping untuk menyimpan setiap jenis sampah yang dicentang
        foreach ($request->waste_type_ids as $index => $typeId) {
            $wasteType = WasteType::findOrFail($typeId);
            
            // Tambahkan nomor urut di belakang kode booking agar UNIQUE di database
            $uniqueCode = $baseBookingCode . '-' . ($index + 1);
            
            Transaction::create([
                'trx_code' => $uniqueCode,
                'reference_code' => $uniqueCode,
                'user_id' => Auth::id(),
                'waste_type_id' => $wasteType->id,
                'jenis_sampah' => $wasteType->name, 
                'berat_kg' => null,     
                'total_harga' => null,  
                'type' => 'deposit',
                'status' => 'pending',
                'queue_number' => $queueNumber, // Nomor antrean tetap SAMA untuk semua item
                'expires_at' => $expiresAt,
            ]);
        }

        return back()->with('success', 'Booking Setor Sampah Berhasil! Tunjukkan Tiket Antrean Anda ke Petugas.');
    }

    public function redeemReward(Request $request)
    {
        $request->validate([
            'reward_id' => 'required|exists:rewards,id',
        ]);

        $reward = Reward::findOrFail($request->reward_id);
        $user = Auth::user();

        if ($reward->stock < 1) {
            return back()->with('error', 'Maaf, stok barang ini di lokasi sedang habis.');
        }

        if ($user->balance < $reward->price) {
            return back()->with('error', 'Saldo bank sampah Anda tidak mencukupi.');
        }

        $otpCode = rand(100000, 999999);
        $redeemCode = 'TK-' . date('ymd') . '-' . strtoupper(Str::random(4));
        
        // Expiry khusus untuk pengambilan hadiah (misal 24 jam)
        $expiresAt = now()->addHours(24);

        $reward->decrement('stock', 1);
        $user->decrement('balance', $reward->price); 

        Transaction::create([
            'trx_code' => $redeemCode,
            'reference_code' => $redeemCode,
            'user_id' => $user->id,
            'reward_id' => $reward->id,
            'jenis_sampah' => $reward->name, 
            'total_harga' => $reward->price,
            'otp_code' => $otpCode, 
            'type' => 'redemption',
            'status' => 'hold', 
            // Tambahkan kolom antrean
            'queue_number' => 'RWD-' . $otpCode,
            'expires_at' => $expiresAt,
        ]);

        return back()->with('success', 'Penukaran berhasil diajukan! Berikan PIN OTP ke Admin di lokasi.');
    }
}