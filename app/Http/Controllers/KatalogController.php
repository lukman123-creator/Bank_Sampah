<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KatalogController extends Controller
{
    public function index()
    {
        $saldo = Auth::user()->balance;
        return view('katalog', compact('saldo'));
    }

    public function tukar(Request $request)
    {
        $request->validate([
            'harga' => 'required|numeric|min:1',
            'nama_hadiah' => 'required|string'
        ]);

        $user = Auth::user();
        $harga_hadiah = $request->harga;
        $nama_hadiah = $request->nama_hadiah;

        if ($user->balance < $harga_hadiah) {
            return back()->with('error', 'Maaf, saldo kamu tidak cukup!');
        }

        // Potong saldo
        $user->decrement('balance', $harga_hadiah);

        // Catat transaksi penarikan
        Transaction::create([
            'user_id' => $user->id,
            'jenis_sampah' => 'Penarikan: ' . $nama_hadiah,
            'berat_kg' => 0,
            'total_harga' => $harga_hadiah, // Positif di log tapi ini type withdrawal
            'type' => 'withdrawal',
            'status' => 'sukses'
        ]);

        return back()->with('success', 'Berhasil menukar ' . $nama_hadiah . '! Saldo kamu telah dipotong.');
    }
}
