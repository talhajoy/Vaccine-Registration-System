@extends('layouts.app')

@section('title', 'Registration Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-file-medical me-2"></i>Registration #{{ $registration->id }}
                    </h4>
                    <span class="badge bg-{{ $registration->statusColor }} status-badge fs-6">
                        {{ ucfirst($registration->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">VACCINE INFORMATION</h6>
                            <p class="mb-1"><strong>Vaccine:</strong> {{ $registration->vaccine->name }}</p>
                            <p class="mb-1"><strong>Manufacturer:</strong> {{ $registration->vaccine->manufacturer }}</p>
                            <p class="mb-3"><strong>Dose Number:</strong> {{ $registration->dose_number }} of {{ $registration->vaccine->doses_required }}</p>

                            <h6 class="text-muted">VACCINATION CENTER</h6>
                            <p class="mb-1"><strong>Name:</strong> {{ $registration->vaccineCenter->name }}</p>
                            <p class="mb-1"><strong>Address:</strong> {{ $registration->vaccineCenter->address }}</p>
                            <p class="mb-1"><strong>City:</strong> {{ $registration->vaccineCenter->city }}</p>
                            <p class="mb-3"><strong>Phone:</strong> {{ $registration->vaccineCenter->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">APPOINTMENT DETAILS</h6>
                            <p class="mb-1"><strong>Preferred Date:</strong> {{ $registration->preferred_date->format('M d, Y') }}</p>
                            @if($registration->scheduled_date)
                            <p class="mb-1"><strong>Scheduled Date:</strong> {{ $registration->scheduled_date->format('M d, Y') }}</p>
                            @if($registration->scheduled_time)
                            <p class="mb-1"><strong>Scheduled Time:</strong> {{ $registration->scheduled_time->format('H:i') }}</p>
                            @endif
                            @endif
                            <p class="mb-3"><strong>Registration Date:</strong> {{ $registration->created_at->format('M d, Y H:i') }}</p>

                            @if($registration->health_conditions)
                            <h6 class="text-muted">HEALTH CONDITIONS</h6>
                            <p class="mb-3">{{ $registration->health_conditions }}</p>
                            @endif
                        </div>
                    </div>

                    @if($registration->vaccinationRecord)
                    <div class="alert alert-success">
                        <h6 class="alert-heading">
                            <i class="fas fa-check-circle me-2"></i>Vaccination Completed
                        </h6>
                        <p class="mb-1"><strong>Date:</strong> {{ $registration->vaccinationRecord->vaccination_date->format('M d, Y') }}</p>
                        <p class="mb-1"><strong>Time:</strong> {{ $registration->vaccinationRecord->vaccination_time->format('H:i') }}</p>
                        <p class="mb-1"><strong>Batch Number:</strong> {{ $registration->vaccinationRecord->batch_number }}</p>
                        <p class="mb-1"><strong>Administered By:</strong> {{ $registration->vaccinationRecord->administered_by }}</p>
                        @if($registration->vaccinationRecord->next_dose_due)
                        <p class="mb-0"><strong>Next Dose Due:</strong> {{ $registration->vaccinationRecord->next_dose_due->format('M d, Y') }}</p>
                        @endif
                        <a href="{{ route('registrations.certificate', $registration) }}" class="btn btn-success mt-3" target="_blank">
                            <i class="fas fa-file-download me-2"></i>View/Download Certificate
                        </a>
                    </div>
                    @endif

                    @if($registration->notes)
                    <div class="alert alert-info">
                        <h6 class="alert-heading">
                            <i class="fas fa-sticky-note me-2"></i>Notes
                        </h6>
                        <p class="mb-0">{{ $registration->notes }}</p>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('registrations.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                        @if($registration->canBeCancelled())
                        <form method="POST" action="{{ route('registrations.cancel', $registration) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to cancel this registration?')">
                                <i class="fas fa-times me-2"></i>Cancel Registration
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection