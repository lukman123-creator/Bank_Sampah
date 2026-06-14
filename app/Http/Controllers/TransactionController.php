<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\WasteType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        // Menampilkan transaksi milik user yang sedang login
        $transactions = Transaction::where('user_id', Auth::id())->latest()->get();
        $wasteTypes = WasteType::all();

        return view('transactions.index', compact('transactions', 'wasteTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'waste_type_id' => 'required|exists:waste_types,id',
            'berat_kg' => 'required|numeric|min:0.1',
        ]);

        $wasteType = WasteType::findOrFail($request->waste_type_id);

        Transaction::create([
            'reference_code' => $wasteType->prefix_code . '-' . strtoupper(Str::random(6)),
            'user_id' => Auth::id(),
            'waste_type_id' => $wasteType->id,
            'jenis_sampah' => $wasteType->name, // Simpan nama sebagai histori
            'berat_kg' => $request->berat_kg,
            'total_harga' => $request->berat_kg * $wasteType->price_per_kg,
            'type' => 'deposit',
            'status' => 'pending',
        ]);

        return back()->with('success', 'Transaksi berhasil ditambahkan!');
    }
}
