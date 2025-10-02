@extends('layouts.app')

@section('title', 'Manage Registrations')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="fas fa-calendar-check me-2"></i>Manage Registrations
        </h2>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="mb-0">All Registrations</h6>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="scheduled">Scheduled</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Contact</th>
                            <th>Vaccine</th>
                            <th>Center</th>
                            <th>Preferred Date</th>
                            <th>Scheduled Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $registration)
                        <tr data-status="{{ $registration->status }}">
                            <td>{{ $registration->id }}</td>
                            <td>
                                <strong>{{ $registration->user->name }}</strong><br>
                                <small class="text-muted">ID: {{ $registration->user->national_id }}</small>
                            </td>
                            <td>
                                {{ $registration->user->email }}<br>
                                <small class="text-muted">{{ $registration->user->phone }}</small>
                            </td>
                            <td>
                                {{ $registration->vaccine->name }}<br>
                                <small class="text-muted">Dose {{ $registration->dose_number }}</small>
                            </td>
                            <td>{{ $registration->vaccineCenter->name }}</td>
                            <td>{{ $registration->preferred_date->format('M d, Y') }}</td>
                            <td>
                                @if($registration->scheduled_date)
                                {{ $registration->scheduled_date->format('M d, Y') }}
                                @if($registration->scheduled_time)
                                <br><small class="text-muted">{{ $registration->scheduled_time->format('H:i') }}</small>
                                @endif
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $registration->statusColor }}">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @if($registration->status === 'pending')
                                    <a href="{{ route('admin.registrations.schedule', $registration) }}"
                                        class="btn btn-outline-primary" title="Schedule">
                                        <i class="fas fa-calendar-plus"></i>
                                    </a>
                                    @elseif($registration->status === 'scheduled')
                                    <form action="{{ route('admin.registrations.complete', $registration->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-success" title="Mark as Completed" onclick="return confirm('Mark this registration as completed?');">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    @endif
                                    <button class="btn btn-outline-info" title="View Details"
                                        onclick="showDetails('{{ $registration->id }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No registrations found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($registrations->hasPages())
        <div class="card-footer">
            {{ $registrations->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registration Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Status filter functionality
    document.getElementById('statusFilter').addEventListener('change', function() {
        const filterValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr[data-status]');

        rows.forEach(row => {
            const status = row.getAttribute('data-status').toLowerCase();
            if (filterValue === '' || status === filterValue) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Show details function (placeholder)
    function showDetails(registrationId) {
        // In a real implementation, you would fetch details via AJAX
        document.getElementById('modalContent').innerHTML = '<p>Loading details for registration #' + registrationId + '...</p>';
        new bootstrap.Modal(document.getElementById('detailsModal')).show();
    }
</script>
@endsection