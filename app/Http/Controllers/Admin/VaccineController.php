<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    public function index()
    {
        $vaccines = \App\Models\Vaccine::all();
        return view('admin.vaccines.index', compact('vaccines'));
    }

    public function create()
    {
        return view('admin.vaccines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'description' => 'nullable|string',
            'doses_required' => 'required|integer|min:1',
            'days_between_doses' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);
        \App\Models\Vaccine::create($request->all());
        return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine added successfully!');
    }

    public function edit(\App\Models\Vaccine $vaccine)
    {
        return view('admin.vaccines.edit', compact('vaccine'));
    }

    public function update(Request $request, \App\Models\Vaccine $vaccine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'description' => 'nullable|string',
            'doses_required' => 'required|integer|min:1',
            'days_between_doses' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);
        $vaccine->update($request->all());
        return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine updated successfully!');
    }

    public function destroy(\App\Models\Vaccine $vaccine)
    {
        $vaccine->delete();
        return redirect()->route('admin.vaccines.index')->with('success', 'Vaccine deleted successfully!');
    }
}
