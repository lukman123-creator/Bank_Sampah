<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total berat sampah yang pernah disetor (hanya deposit)
        $total_berat = Transaction::where('user_id', $user->id)
            ->where('type', 'deposit')
            ->sum('berat_kg');

        // Saldo sekarang langsung diambil dari kolom balance di tabel users
        $total_saldo = $user->balance;

        // Ambil 5 riwayat transaksi terakhir
        $recent_transactions = Transaction::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('total_berat', 'total_saldo', 'recent_transactions'));
    }
}
