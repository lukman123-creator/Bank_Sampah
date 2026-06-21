<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        // Panggil data dari yang terbaru (latest) biar yang baru ditambahin muncul di atas
        $rewards = Reward::latest()->get();

        return view('admin.rewards.index', compact('rewards'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0', // Tambahan validasi stok
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Reward::create($validated);

        return back()->with('success', 'Hadiah berhasil ditambahkan!');
    }

    public function update(Request $request, Reward $reward)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0', // Tambahan validasi stok
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $reward->update($validated);

        return back()->with('success', 'Data hadiah berhasil diupdate!');
    }

    public function destroy(Reward $reward)
    {
        $reward->delete();

        return back()->with('success', 'Hadiah berhasil dihapus!');
    }
}