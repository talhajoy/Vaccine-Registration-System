@extends('layouts.app')

@section('title', 'My Registrations')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="fas fa-list me-2"></i>My Registrations
        </h2>
        <a href="{{ route('registrations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>New Registration
        </a>
    </div>

    <div class="row">
        @forelse($registrations as $registration)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Registration #{{ $registration->id }}</h6>
                    <span class="badge bg-{{ $registration->statusColor }} status-badge">
                        {{ ucfirst($registration->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $registration->vaccine->name }}</h5>
                    <p class="card-text">
                        <i class="fas fa-hospital me-1"></i>{{ $registration->vaccineCenter->name }}<br>
                        <i class="fas fa-map-marker-alt me-1"></i>{{ $registration->vaccineCenter->city }}<br>
                        <i class="fas fa-calendar me-1"></i>
                        @if($registration->scheduled_date)
                        Scheduled: {{ $registration->scheduled_date->format('M d, Y') }}
                        @if($registration->scheduled_time)
                        at {{ $registration->scheduled_time->format('H:i') }}
                        @endif
                        @else
                        Preferred: {{ $registration->preferred_date->format('M d, Y') }}
                        @endif
                        <br>
                        <i class="fas fa-syringe me-1"></i>Dose {{ $registration->dose_number }}
                    </p>
                </div>
                <div class="card-footer">
                    <div class="d-flex gap-2">
                        <a href="{{ route('registrations.show', $registration) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>View
                        </a>
                        @if($registration->canBeCancelled())
                        <form method="POST" action="{{ route('registrations.cancel', $registration) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('Are you sure you want to cancel this registration?')">
                                <i class="fas fa-times me-1"></i>Cancel
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card text-center">
                <div class="card-body py-5">
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    <h5>No Registrations Yet</h5>
                    <p class="text-muted">You haven't registered for vaccination yet.</p>
                    <a href="{{ route('registrations.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Register Now
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection