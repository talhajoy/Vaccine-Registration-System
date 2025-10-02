@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                <small class="text-muted">Welcome, {{ Auth::user()->name }}</small>
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">My Registrations</h5>
                            <h2>{{ Auth::user()->registrations()->count() }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('registrations.index') }}" class="text-white text-decoration-none">
                        View Details <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Completed Doses</h5>
                            <h2>{{ Auth::user()->vaccinationRecords()->count() }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-syringe fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Age</h5>
                            <h2>{{ Auth::user()->age }} years</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-birthday-cake fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>Recent Registrations
                    </h5>
                </div>
                <div class="card-body">
                    @forelse(Auth::user()->registrations()->with(['vaccineCenter', 'vaccine', 'vaccinationRecord'])->latest()->take(5)->get() as $registration)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <strong>{{ $registration->vaccine->name }}</strong><br>
                            <small class="text-muted">{{ $registration->vaccineCenter->name }}</small>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-{{ $registration->statusColor }} status-badge">
                                {{ ucfirst($registration->status) }}
                            </span><br>
                            <small class="text-muted">{{ $registration->created_at->format('M d, Y') }}</small>
                            @if($registration->vaccinationRecord)
                            <a href="{{ route('registrations.certificate', $registration) }}" class="btn btn-success btn-sm mt-2" target="_blank">
                                <i class="fas fa-file-download me-1"></i>Certificate
                            </a>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="text-muted mb-0">No registrations yet.</p>
                    @endforelse
                </div>
                @if(Auth::user()->registrations()->count() > 5)
                <div class="card-footer text-center">
                    <a href="{{ route('registrations.index') }}" class="btn btn-outline-primary btn-sm">
                        View All Registrations
                    </a>
                </div>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-plus me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('registrations.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>New Registration
                        </a>
                        <a href="{{ route('registrations.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i>View All Registrations
                        </a>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-user me-2"></i>Profile Information
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ Auth::user()->phone }}</p>
                    <p class="mb-0"><strong>National ID:</strong> {{ Auth::user()->national_id }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection