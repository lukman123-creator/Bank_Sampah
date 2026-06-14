<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();
        return view('admin.rewards.index', compact('rewards'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
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
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $reward->update($validated);
        return back()->with('success', 'Hadiah berhasil diupdate!');
    }

    public function destroy(Reward $reward)
    {
        $reward->delete();
        return back()->with('success', 'Hadiah berhasil dihapus!');
    }
}
