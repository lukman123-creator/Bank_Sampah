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
        $rewards = Reward::all();

        return view('katalog', compact('saldo', 'rewards'));
    }

    public function tukar(Request $request)
    {
        $request->validate([
            'reward_id' => 'required|exists:rewards,id',
        ]);

        $user = Auth::user();
        $reward = Reward::find($request->reward_id);

        if ($user->balance < $reward->price) {
            return back()->with('error', 'Maaf, saldo kamu tidak cukup untuk menukar '.$reward->name.'!');
        }

        // Potong saldo
        $user->decrement('balance', $reward->price);

        // Catat transaksi penarikan
        Transaction::create([
            'reference_code' => 'TRX-' . strtoupper(Str::random(6)),
            'user_id' => $user->id,
            'jenis_sampah' => 'Penukaran: '.$reward->name,
            'berat_kg' => 0,
            'total_harga' => $reward->price,
            'type' => 'withdrawal',
            'status' => 'sukses',
        ]);

        return back()->with('success', 'Berhasil menukar '.$reward->name.'! Saldo kamu telah dipotong.');
    }

    public function withdrawBank(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'amount' => 'required|numeric|min:10000',
        ]);

        $user = Auth::user();
        $amount = $request->amount;

        if ($user->balance < $amount) {
            return back()->with('error', 'Maaf, saldo kamu tidak cukup untuk ditarik sebesar Rp '.number_format($amount, 0, ',', '.').'!');
        }

        // Potong saldo
        $user->decrement('balance', $amount);

        // Catat transaksi penarikan
        Transaction::create([
            'reference_code' => 'TRX-' . strtoupper(Str::random(6)),
            'user_id' => $user->id,
            'jenis_sampah' => 'Tarik Tunai Bank: '.$request->bank_name.' ('.$request->account_number.')',
            'berat_kg' => 0,
            'total_harga' => $amount,
            'type' => 'withdrawal',
            'status' => 'sukses',
        ]);

        return back()->with('success', 'Berhasil melakukan penarikan ke '.$request->bank_name.' sejumlah Rp '.number_format($amount, 0, ',', '.').' (Simulasi). Saldo kamu telah dipotong.');
    }
}
