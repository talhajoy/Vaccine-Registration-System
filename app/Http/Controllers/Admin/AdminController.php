<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Registration;
use App\Models\VaccineCenter;
use App\Models\Vaccine;
use App\Models\VaccinationRecord;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function certificate(Registration $registration)
    {
        $record = VaccinationRecord::where('registration_id', $registration->id)->first();
        return view('admin.certificate', compact('registration', 'record'));
    }
    public function completeRegistration(Registration $registration)
    {
        $registration->update(['status' => 'completed']);
        // Optionally, create a VaccinationRecord here
        VaccinationRecord::create([
            'user_id' => $registration->user_id,
            'registration_id' => $registration->id,
            'vaccine_id' => $registration->vaccine_id,
            'vaccine_center_id' => $registration->vaccine_center_id,
            'dose_number' => $registration->dose_number,
            'vaccination_date' => $registration->scheduled_date ?? now()->toDateString(),
            'vaccination_time' => $registration->scheduled_time ?? now()->format('H:i'),
            'batch_number' => 'AUTO-GEN',
            'administered_by' => 'Admin',
            'side_effects' => null,
            'next_dose_due' => null,
        ]);
        return redirect()->route('admin.registrations')->with('success', 'Registration marked as completed.');
    }
    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_registrations' => Registration::count(),
            'pending_registrations' => Registration::where('status', 'pending')->count(),
            'completed_vaccinations' => VaccinationRecord::count(),
            'total_centers' => VaccineCenter::count(),
            'total_vaccines' => Vaccine::count(),
        ];

        $recentRegistrations = Registration::with(['user', 'vaccineCenter', 'vaccine'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentRegistrations'));
    }

    public function registrations()
    {
        $registrations = Registration::with(['user', 'vaccineCenter', 'vaccine'])
            ->latest()
            ->paginate(20);

        return view('admin.registrations', compact('registrations'));
    }

    public function scheduleRegistration(Registration $registration)
    {
        $vaccineCenters = VaccineCenter::where('is_active', true)->get();

        return view('admin.schedule-registration', compact('registration', 'vaccineCenters'));
    }

    public function updateSchedule(Request $request, Registration $registration)
    {
        $request->validate([
            'scheduled_date' => 'required|date|after_or_equal:today',
            'scheduled_time' => 'required|date_format:H:i',
            'vaccine_center_id' => 'required|exists:vaccine_centers,id',
        ]);

        // Check center capacity
        $center = VaccineCenter::find($request->vaccine_center_id);
        $availableSlots = $center->getAvailableSlotsForDate($request->scheduled_date);

        if ($availableSlots <= 0) {
            return back()->withErrors(['error' => 'No available slots for the selected date.']);
        }

        $registration->update([
            'scheduled_date' => $request->scheduled_date,
            'scheduled_time' => $request->scheduled_time,
            'vaccine_center_id' => $request->vaccine_center_id,
            'status' => 'scheduled',
        ]);

        return redirect()->route('admin.registrations')
            ->with('success', 'Registration scheduled successfully!');
    }
}
