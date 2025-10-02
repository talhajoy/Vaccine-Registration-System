@extends('layouts.app')

@section('title', 'Schedule Registration')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-calendar-plus me-2"></i>Schedule Registration #{{ $registration->id }}
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Registration Info -->
                    <div class="alert alert-info">
                        <h6 class="alert-heading">Registration Information</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>User:</strong> {{ $registration->user->name }}</p>
                                <p class="mb-1"><strong>Email:</strong> {{ $registration->user->email }}</p>
                                <p class="mb-1"><strong>Phone:</strong> {{ $registration->user->phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Vaccine:</strong> {{ $registration->vaccine->name }}</p>
                                <p class="mb-1"><strong>Preferred Date:</strong> {{ $registration->preferred_date->format('M d, Y') }}</p>
                                <p class="mb-0"><strong>Current Center:</strong> {{ $registration->vaccineCenter->name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Scheduling Form -->
                    <form method="POST" action="{{ route('admin.registrations.update-schedule', $registration) }}">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="scheduled_date" class="form-label">Scheduled Date *</label>
                                <input id="scheduled_date" type="date"
                                    class="form-control @error('scheduled_date') is-invalid @enderror"
                                    name="scheduled_date" value="{{ old('scheduled_date', $registration->preferred_date->format('Y-m-d')) }}"
                                    min="{{ date('Y-m-d') }}" required>
                                @error('scheduled_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="scheduled_time" class="form-label">Scheduled Time *</label>
                                <input id="scheduled_time" type="time"
                                    class="form-control @error('scheduled_time') is-invalid @enderror"
                                    name="scheduled_time" value="{{ old('scheduled_time', '09:00') }}" required>
                                @error('scheduled_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="vaccine_center_id" class="form-label">Vaccination Center *</label>
                            <select id="vaccine_center_id" name="vaccine_center_id"
                                class="form-select @error('vaccine_center_id') is-invalid @enderror" required>
                                @foreach($vaccineCenters as $center)
                                <option value="{{ $center->id }}"
                                    {{ (old('vaccine_center_id', $registration->vaccine_center_id) == $center->id) ? 'selected' : '' }}>
                                    {{ $center->name }} - {{ $center->city }}
                                    (Capacity: {{ $center->daily_capacity }} per day)
                                </option>
                                @endforeach
                            </select>
                            @error('vaccine_center_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3" id="capacityInfo">
                            <!-- Capacity information will be shown here -->
                        </div>

                        @if($registration->health_conditions)
                        <div class="alert alert-warning">
                            <h6 class="alert-heading">
                                <i class="fas fa-exclamation-triangle me-2"></i>Health Conditions
                            </h6>
                            <p class="mb-0">{{ $registration->health_conditions }}</p>
                        </div>
                        @endif

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.registrations') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-calendar-check me-2"></i>Schedule Appointment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Check capacity when date or center changes
    function checkCapacity() {
        const date = document.getElementById('scheduled_date').value;
        const centerId = document.getElementById('vaccine_center_id').value;

        if (date && centerId) {
            // In a real implementation, you would make an AJAX call to check capacity
            // For now, we'll just show a placeholder
            document.getElementById('capacityInfo').innerHTML =
                '<div class="alert alert-info"><i class="fas fa-info-circle me-2"></i>Checking availability for selected date and center...</div>';

            // Simulate API call
            setTimeout(() => {
                const availableSlots = Math.floor(Math.random() * 50) + 10; // Random number for demo
                document.getElementById('capacityInfo').innerHTML =
                    '<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>Available slots: ' + availableSlots + '</div>';
            }, 1000);
        }
    }

    document.getElementById('scheduled_date').addEventListener('change', checkCapacity);
    document.getElementById('vaccine_center_id').addEventListener('change', checkCapacity);

    // Initial capacity check
    checkCapacity();
</script>
@endsection