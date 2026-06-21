<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\WasteStock;
use App\Models\CollectorSale;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil semua transaksi dari yang paling baru
        $transactions = Transaction::with(['user'])->latest()->get();
        
        return view('admin.dashboard', compact('transactions'));
    }

    public function approveDeposit(Request $request, $id)
    {
        $request->validate([
            'berat_kg' => 'required|numeric|min:0.1',
        ]);

        $transaction = Transaction::with(['user', 'wasteType'])->findOrFail($id);

        $pricePerKg = $transaction->wasteType ? $transaction->wasteType->price_per_kg : 0;
        $totalHarga = $request->berat_kg * $pricePerKg;

        $transaction->update([
            'berat_kg' => $request->berat_kg,
            'total_harga' => $totalHarga,
            'status' => 'sukses',
        ]);

        $transaction->user->increment('balance', $totalHarga);

        // FR-01: TAMBAH STOK OTOMATIS KE GUDANG
        if ($transaction->waste_type_id) {
            $stock = WasteStock::firstOrCreate(
                ['waste_type_id' => $transaction->waste_type_id],
                ['available_kg' => 0]
            );
            $stock->increment('available_kg', $request->berat_kg);
        }

        return back()->with('success', 'Setoran berhasil diverifikasi! Saldo warga bertambah dan stok gudang diperbarui.');
    }

    public function approveRedeem(Request $request, $id)
    {
        $request->validate([
            'otp_code' => 'required|string|size:6',
        ]);

        $transaction = Transaction::findOrFail($id);

        if ($transaction->otp_code !== $request->otp_code) {
            return back()->with('error', 'Gagal! PIN OTP salah atau tidak sesuai.');
        }

        $transaction->update([
            'status' => 'sukses',
        ]);

        return back()->with('success', 'Verifikasi PIN Sukses! Hadiah fisik aman diserahkan ke warga.');
    }

    public function users()
    {
        $users = \App\Models\User::where('id', '!=', auth()->id())->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function approveWithdrawal(\Illuminate\Http\Request $request, \App\Models\Transaction $transaction)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($transaction->type === 'withdrawal' && $transaction->status === 'pending') {
            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $fileName = 'BUKTI_WD_' . $transaction->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/bukti_transfer'), $fileName);
                
                $transaction->update([
                    'status' => 'sukses',
                    'otp_code' => 'uploads/bukti_transfer/' . $fileName
                ]);
            }

            return back()->with('success', 'Transaksi Tarik Tunai selesai! Bukti transfer berhasil diunggah.');
        }

        return back()->with('error', 'Transaksi tidak valid.');
    }

    public function rejectWithdrawal(\App\Models\Transaction $transaction)
    {
        if ($transaction->type === 'withdrawal' && $transaction->status === 'pending') {
            
            $transaction->user->increment('balance', $transaction->total_harga);

            $transaction->update([
                'status' => 'ditolak'
            ]);

            return back()->with('error', 'Penarikan ditolak karena data tidak valid. Saldo telah dikembalikan ke nasabah.');
        }

        return back()->with('error', 'Transaksi tidak valid.');
    }

    public function stocksIndex()
    {
        $stocks = WasteStock::with('wasteType')->get();
        return view('admin.stocks.index', compact('stocks'));
    }

    public function salesIndex()
    {
        $sales = CollectorSale::with('wasteType')->latest()->get();
        return view('admin.sales.index', compact('sales'));
    }

    public function sellToCollector(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'waste_type_id' => 'required|exists:waste_types,id',
            'collector_name' => 'required|string|max:255',
            'weight_kg' => 'required|numeric|min:0.1',
            'price_per_kg' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        $stock = WasteStock::where('waste_type_id', $request->waste_type_id)->first();

        if (!$stock || $request->weight_kg > $stock->available_kg) {
            return back()->with('error', 'Transaksi Ditolak: Stok sampah tidak mencukupi.');
        }

        $totalSale = $request->weight_kg * $request->price_per_kg;

        CollectorSale::create([
            'waste_type_id' => $request->waste_type_id,
            'collector_name' => $request->collector_name,
            'weight_kg' => $request->weight_kg,
            'price_per_kg' => $request->price_per_kg,
            'total_sale' => $totalSale,
            'notes' => $request->notes
        ]);

        $stock->decrement('available_kg', $request->weight_kg);

        return back()->with('success', 'Penjualan ke pengepul berhasil dicatat. Stok gudang otomatis dikurangi.');
    }
    public function transactionsIndex()
    {
        $transactions = \App\Models\Transaction::with(['user', 'wasteType'])->latest()->get();
        return view('admin.transactions.index', compact('transactions'));
    }
}