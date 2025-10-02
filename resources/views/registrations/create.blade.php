@extends('layouts.app')

@section('title', 'New Registration')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-plus me-2"></i>New Vaccination Registration
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('registrations.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="vaccine_id" class="form-label">Select Vaccine *</label>
                            <select id="vaccine_id" name="vaccine_id" class="form-select @error('vaccine_id') is-invalid @enderror" required>
                                <option value="">Choose a vaccine...</option>
                                @foreach($vaccines as $vaccine)
                                <option value="{{ $vaccine->id }}" {{ old('vaccine_id') == $vaccine->id ? 'selected' : '' }}>
                                    {{ $vaccine->name }} ({{ $vaccine->manufacturer }}) -
                                    {{ $vaccine->doses_required }} dose(s)
                                </option>
                                @endforeach
                            </select>
                            @error('vaccine_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="vaccine_center_id" class="form-label">Select Vaccination Center *</label>
                            <select id="vaccine_center_id" name="vaccine_center_id" class="form-select @error('vaccine_center_id') is-invalid @enderror" required>
                                <option value="">Choose a center...</option>
                                @foreach($vaccineCenters as $center)
                                <option value="{{ $center->id }}" {{ old('vaccine_center_id') == $center->id ? 'selected' : '' }}>
                                    {{ $center->name }} - {{ $center->city }}
                                    (Capacity: {{ $center->daily_capacity }} per day)
                                </option>
                                @endforeach
                            </select>
                            @error('vaccine_center_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="preferred_date" class="form-label">Preferred Date *</label>
                            <input id="preferred_date" type="date"
                                class="form-control @error('preferred_date') is-invalid @enderror"
                                name="preferred_date" value="{{ old('preferred_date') }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            @error('preferred_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Select your preferred vaccination date (must be at least tomorrow)</div>
                        </div>

                        <div class="mb-3">
                            <label for="health_conditions" class="form-label">Health Conditions</label>
                            <textarea id="health_conditions" name="health_conditions"
                                class="form-control @error('health_conditions') is-invalid @enderror"
                                rows="4" placeholder="Please mention any allergies, chronic conditions, or medications you are currently taking...">{{ old('health_conditions') }}</textarea>
                            @error('health_conditions')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">This information helps medical staff prepare for your vaccination</div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Please note:</strong> Your registration will be reviewed and you will be notified once your appointment is scheduled. The actual appointment date may differ from your preferred date based on availability.
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('registrations.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Submit Registration
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection