@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
            </h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-2">
            <a href="{{ route('admin.registrations') }}" class="text-decoration-none">
                <div class="card text-white bg-primary">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <h3>{{ $stats['total_users'] }}</h3>
                        <p class="mb-0">Total Users</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.registrations') }}" class="text-decoration-none">
                <div class="card text-white bg-info">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-check fa-2x mb-2"></i>
                        <h3>{{ $stats['total_registrations'] }}</h3>
                        <p class="mb-0">Registrations</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.registrations') }}?status=pending" class="text-decoration-none">
                <div class="card text-white bg-warning">
                    <div class="card-body text-center">
                        <i class="fas fa-clock fa-2x mb-2"></i>
                        <h3>{{ $stats['pending_registrations'] }}</h3>
                        <p class="mb-0">Pending</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.registrations') }}?status=completed" class="text-decoration-none">
                <div class="card text-white bg-success">
                    <div class="card-body text-center">
                        <i class="fas fa-syringe fa-2x mb-2"></i>
                        <h3>{{ $stats['completed_vaccinations'] }}</h3>
                        <p class="mb-0">Completed</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.centers.index') }}" class="text-decoration-none">
                <div class="card text-white bg-secondary">
                    <div class="card-body text-center">
                        <i class="fas fa-hospital fa-2x mb-2"></i>
                        <h3>{{ $stats['total_centers'] }}</h3>
                        <p class="mb-0">Centers</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.vaccines.index') }}" class="text-decoration-none">
                <div class="card text-white bg-dark">
                    <div class="card-body text-center">
                        <i class="fas fa-vial fa-2x mb-2"></i>
                        <h3>{{ $stats['total_vaccines'] }}</h3>
                        <p class="mb-0">Vaccines</p>
                    </div>
                </div>
            </a>
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
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Vaccine</th>
                                    <th>Center</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentRegistrations as $registration)
                                <tr>
                                    <td>{{ $registration->id }}</td>
                                    <td>{{ $registration->user->name }}</td>
                                    <td>{{ $registration->vaccine->name }}</td>
                                    <td>{{ $registration->vaccineCenter->name }}</td>
                                    <td>
                                        <span class="badge bg-{{ $registration->statusColor }}">
                                            {{ ucfirst($registration->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $registration->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if($registration->status === 'pending')
                                        <a href="{{ route('admin.registrations.schedule', $registration) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Schedule
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No recent registrations</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('admin.registrations') }}" class="btn btn-outline-primary">
                        View All Registrations
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Registration Status
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Pending</span>
                            <span class="badge bg-warning">{{ $stats['pending_registrations'] }}</span>
                        </div>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-warning" style="width: {{ $stats['total_registrations'] > 0 ? ($stats['pending_registrations'] / $stats['total_registrations']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Completed</span>
                            <span class="badge bg-success">{{ $stats['completed_vaccinations'] }}</span>
                        </div>
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar bg-success" style="width: {{ $stats['total_registrations'] > 0 ? intval(($stats['completed_vaccinations'] / $stats['total_registrations']) * 100) : 0 }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-tools me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.registrations') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-calendar-check me-2"></i>Manage Registrations
                        </a>
                        <a href="{{ route('admin.centers.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-hospital me-2"></i>Manage Centers
                        </a>
                        <a href="{{ route('admin.vaccines.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-vial me-2"></i>Manage Vaccines
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection