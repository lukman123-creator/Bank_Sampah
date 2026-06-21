<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminAnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        $query = Transaction::with(['user', 'wasteType'])
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year);

        $allTransactions = $query->latest()->get();
        $semuaTrxSukses = $allTransactions->whereIn('status', ['sukses', 'approved']);

        $totalDeposit = $semuaTrxSukses->where('type', 'deposit')->sum('total_harga');
        $totalBerat = $semuaTrxSukses->where('type', 'deposit')->sum('berat_kg');
        $totalTarik = $semuaTrxSukses->whereIn('type', ['withdrawal', 'redemption'])->sum('total_harga');

        $chartData = $semuaTrxSukses->where('type', 'deposit')
            ->groupBy('waste_type_id')
            ->map(function ($group) {
                return [
                    'name' => $group->first()->wasteType->name ?? 'Lainnya',
                    'total' => $group->sum('berat_kg')
                ];
            })->values();

        $barLabels = $chartData->pluck('name')->toJson();
        $barData = $chartData->pluck('total')->toJson();

        return view('admin.analytics', compact(
            'allTransactions', 'totalDeposit', 'totalBerat', 'totalTarik',
            'month', 'year', 'barLabels', 'barData'
        ));
    }
}