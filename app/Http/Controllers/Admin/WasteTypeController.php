<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WasteType;
use Illuminate\Http\Request;

class WasteTypeController extends Controller
{
    public function index()
    {
        $wasteTypes = WasteType::all();
        return view('admin.waste_types.index', compact('wasteTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prefix_code' => 'required|string|max:10|unique:waste_types,prefix_code',
            'price_per_kg' => 'required|integer|min:0',
        ]);

        WasteType::create($request->all());

        return back()->with('success', 'Jenis sampah berhasil ditambahkan!');
    }

    public function update(Request $request, WasteType $wasteType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prefix_code' => 'required|string|max:10|unique:waste_types,prefix_code,' . $wasteType->id,
            'price_per_kg' => 'required|integer|min:0',
        ]);

        $wasteType->update($request->all());

        return back()->with('success', 'Jenis sampah berhasil diubah!');
    }

    public function destroy(WasteType $wasteType)
    {
        $wasteType->delete();

        return back()->with('success', 'Jenis sampah berhasil dihapus!');
    }
}
