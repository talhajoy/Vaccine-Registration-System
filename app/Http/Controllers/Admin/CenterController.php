<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    public function destroy(\App\Models\VaccineCenter $center)
    {
        $center->delete();
        return redirect()->route('admin.centers.index')->with('success', 'Center deleted successfully!');
    }
    public function index()
    {
        $centers = \App\Models\VaccineCenter::all();
        return view('admin.centers.index', compact('centers'));
    }

    public function create()
    {
        return view('admin.centers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);
        \App\Models\VaccineCenter::create([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'is_active' => $request->is_active,
        ]);
        return redirect()->route('admin.centers.index')->with('success', 'Center added successfully!');
    }

    public function edit(\App\Models\VaccineCenter $center)
    {
        return view('admin.centers.edit', compact('center'));
    }

    public function update(Request $request, \App\Models\VaccineCenter $center)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);
        $center->update([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'is_active' => $request->is_active,
        ]);
        return redirect()->route('admin.centers.index')->with('success', 'Center updated successfully!');
    }
}
