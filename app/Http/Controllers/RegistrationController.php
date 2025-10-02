<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\VaccineCenter;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Auth::user()->registrations()
            ->with(['vaccineCenter', 'vaccine'])
            ->latest()
            ->get();

        return view('registrations.index', compact('registrations'));
    }

    public function create()
    {
        $vaccineCenters = VaccineCenter::where('is_active', true)->get();
        $vaccines = Vaccine::where('is_active', true)->get();

        return view('registrations.create', compact('vaccineCenters', 'vaccines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vaccine_center_id' => 'required|exists:vaccine_centers,id',
            'vaccine_id' => 'required|exists:vaccines,id',
            'preferred_date' => 'required|date|after:today',
            'health_conditions' => 'nullable|string|max:1000',
        ]);

        // Check if user already has a pending or scheduled registration
        $existingRegistration = Auth::user()->registrations()
            ->whereIn('status', ['pending', 'scheduled'])
            ->first();

        if ($existingRegistration) {
            return back()->withErrors(['error' => 'You already have a pending or scheduled vaccination.']);
        }

        $registration = Registration::create([
            'user_id' => Auth::id(),
            'vaccine_center_id' => $request->vaccine_center_id,
            'vaccine_id' => $request->vaccine_id,
            'preferred_date' => $request->preferred_date,
            'health_conditions' => $request->health_conditions,
            'status' => 'pending',
            'dose_number' => 1,
        ]);

        return redirect()->route('registrations.show', $registration)
            ->with('success', 'Registration submitted successfully!');
    }

    public function show(Registration $registration)
    {
        $this->authorize('view', $registration);

        $registration->load(['vaccineCenter', 'vaccine', 'vaccinationRecord']);

        return view('registrations.show', compact('registration'));
    }

    public function cancel(Registration $registration)
    {
        $this->authorize('update', $registration);

        if (!$registration->canBeCancelled()) {
            return back()->withErrors(['error' => 'This registration cannot be cancelled.']);
        }

        $registration->update(['status' => 'cancelled']);

        return back()->with('success', 'Registration cancelled successfully.');
    }

    // Certificate view for user
    public function certificate(Registration $registration)
    {
        $this->authorize('view', $registration);
        $record = $registration->vaccinationRecord;
        if (!$record) {
            return back()->withErrors(['error' => 'No vaccination record found for this registration.']);
        }
        return view('admin.certificate', compact('registration', 'record'));
    }
}
