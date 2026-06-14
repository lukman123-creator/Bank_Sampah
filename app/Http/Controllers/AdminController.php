<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil semua transaksi beserta relasi usernya
        $transactions = Transaction::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('transactions'));
    }

    public function approveTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status === 'pending' && $transaction->type === 'deposit') {
            $transaction->status = 'sukses';
            $transaction->save();

            // Tambahkan saldo ke user yang bersangkutan
            $user = User::find($transaction->user_id);
            if ($user) {
                $user->increment('balance', $transaction->total_harga);
            }

            return back()->with('success', 'Transaksi setor sampah berhasil disetujui, saldo User bertambah!');
        }

        return back()->with('error', 'Transaksi tidak valid atau sudah diproses.');
    }
}
