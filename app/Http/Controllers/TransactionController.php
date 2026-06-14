<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        // Menampilkan transaksi milik user yang sedang login
        $transactions = Transaction::where('user_id', Auth::id())->latest()->get();

        return view('transactions.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_sampah' => 'required|string',
            'berat_kg' => 'required|numeric|min:0.1',
        ]);

        // Simulasi harga: Rp 2000 per Kg (Bisa disesuaikan)
        $harga_per_kg = 2000;

        Transaction::create([
            'user_id' => Auth::id(),
            'jenis_sampah' => $request->jenis_sampah,
            'berat_kg' => $request->berat_kg,
            'total_harga' => $request->berat_kg * $harga_per_kg,
            'type' => 'deposit',
            'status' => 'pending',
        ]);

        return back()->with('success', 'Transaksi berhasil ditambahkan!');
    }
}
