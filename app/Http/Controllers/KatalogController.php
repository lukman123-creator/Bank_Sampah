<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KatalogController extends Controller
{
    public function index()
    {
        $saldo = Auth::user()->balance;
        $rewards = Reward::where('stock', '>', 0)->get();
        return view('katalog', compact('saldo', 'rewards'));
    }

    public function tukar(Request $request)
    {
        $request->validate(['reward_id' => 'required|exists:rewards,id']);
        $user = Auth::user();
        $reward = Reward::find($request->reward_id);

        if ($reward->stock < 1) return back()->with('error', 'Maaf, stok habis!');
        if ($user->balance < $reward->price) return back()->with('error', 'Saldo tidak cukup!');

        $user->decrement('balance', $reward->price);
        $reward->decrement('stock', 1);

        $otpCode = rand(100000, 999999);
        $refCode = 'TKR-' . strtoupper(Str::random(6));

        Transaction::create([
            'reference_code' => $refCode,
            'trx_code' => $refCode,
            'user_id' => $user->id,
            // 'reward_id' dihapus agar tidak error SQL
            'jenis_sampah' => 'Klaim Barang: '.$reward->name,
            'berat_kg' => 0,
            'total_harga' => $reward->price,
            'otp_code' => $otpCode,
            'type' => 'redemption',
            'status' => 'hold', // Menunggu OTP
        ]);

        return back()->with('success', 'Booking berhasil! PIN OTP kamu: ' . $otpCode . '. Tunjukkan ke Admin.');
    }

    public function withdrawBank(Request $request)
    {
        // LOGIC VALIDASI KETAT ALA DOSEN
        $request->validate([
            'bank_name' => 'required|string',
            'amount' => 'required|numeric|min:10000',
            'account_number' => ['required', 'string', function ($attribute, $value, $fail) use ($request) {
                // Validasi BCA harus angka dan kisaran 10 digit
                if ($request->bank_name === 'BCA' && !preg_match('/^[0-9]{10}$/', $value)) {
                    $fail('Nomor Rekening BCA harus berupa 10 digit angka.');
                }
                // Validasi E-Wallet harus diawali 08 dan 10-13 digit
                if (in_array($request->bank_name, ['Dana', 'GoPay', 'OVO']) && !preg_match('/^08[0-9]{8,11}$/', $value)) {
                    $fail('Nomor HP E-Wallet tidak valid (Harus diawali 08, min 10 digit).');
                }
            }],
        ]);

        $user = Auth::user();
        $amount = $request->amount;

        if ($user->balance < $amount) return back()->with('error', 'Saldo tidak cukup!');

        // Potong saldo
        $user->decrement('balance', $amount);

        // UBAH LOGIC: Status jadi 'pending', bukan 'sukses'
        Transaction::create([
            'reference_code' => 'WD-' . strtoupper(Str::random(6)),
            'trx_code' => 'WD-' . strtoupper(Str::random(6)),
            'user_id' => $user->id,
            'jenis_sampah' => 'Tarik Tunai: '.$request->bank_name.' ('.$request->account_number.')',
            'berat_kg' => 0,
            'total_harga' => $amount,
            'type' => 'withdrawal',
            'status' => 'pending', // <--- Admin harus setujui dulu nanti!
        ]);

        return back()->with('success', 'Permintaan Tarik Tunai berhasil dibuat! Menunggu admin mentransfer dana.');
    }
}