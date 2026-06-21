<?php

namespace App\Http\Controllers\Admin; // Pastikan namespace-nya ada \Admin

use App\Http\Controllers\Controller;
use App\Models\WasteType;
use Illuminate\Http\Request;

class WasteTypeController extends Controller
{
    public function index()
    {
        $wasteTypes = WasteType::latest()->get();
        return view('admin.waste-types.index', compact('wasteTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'prefix_code' => 'required|string|max:10',
            'price_per_kg' => 'required|numeric|min:0',
        ]);

        WasteType::create($validated);
        return back()->with('success', 'Jenis sampah berhasil ditambahkan!');
    }

    public function update(Request $request, WasteType $wasteType) // Pastikan parameter ini sesuai route
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'prefix_code' => 'required|string|max:10',
            'price_per_kg' => 'required|numeric|min:0',
        ]);

        $wasteType->update($validated);
        return back()->with('success', 'Jenis sampah berhasil diupdate!');
    }

    public function destroy($id)
    {
        // Pakai FindOrFail biar aman
        $wasteType = WasteType::findOrFail($id);
        $wasteType->delete();
        
        return back()->with('success', 'Jenis sampah berhasil dihapus!');
    }
}