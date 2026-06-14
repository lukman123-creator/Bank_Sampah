<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class AdminAnalyticsController extends Controller
{
    public function index()
    {
        // Get withdrawals grouped by name
        $withdrawals = Transaction::where('type', 'withdrawal')
            ->select('jenis_sampah', DB::raw('count(*) as count'), DB::raw('sum(total_harga) as total_amount'))
            ->groupBy('jenis_sampah')
            ->orderBy('count', 'desc')
            ->get();

        // Format for Chart.js
        $chartLabels = $withdrawals->pluck('jenis_sampah')->toArray();
        $chartData = $withdrawals->pluck('count')->toArray();

        return view('admin.analytics', compact('withdrawals', 'chartLabels', 'chartData'));
    }
}
