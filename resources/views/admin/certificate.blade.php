@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3>Vaccination Certificate</h3>
        </div>
        <div class="card-body">
            <h5 class="mb-3">Personal Information</h5>
            <p><strong>Name:</strong> {{ $registration->user->name }}</p>
            <p><strong>Email:</strong> {{ $registration->user->email }}</p>
            <p><strong>National ID:</strong> {{ $registration->user->national_id ?? 'N/A' }}</p>

            <h5 class="mt-4 mb-3">Vaccination Details</h5>
            @if($record)
            <p><strong>Vaccine:</strong> {{ $record->vaccine->name }}</p>
            <p><strong>Center:</strong> {{ $record->vaccineCenter->name }}</p>
            <p><strong>Dose Number:</strong> {{ $record->dose_number }}</p>
            <p><strong>Date:</strong> {{ $record->vaccination_date }}</p>
            <p><strong>Time:</strong> {{ $record->vaccination_time }}</p>
            <p><strong>Batch Number:</strong> {{ $record->batch_number }}</p>
            <p><strong>Administered By:</strong> {{ $record->administered_by }}</p>
            @else
            <p class="text-danger">No vaccination record found.</p>
            @endif

            <div class="mt-4">
                <span class="badge bg-success">Status: Completed</span>
            </div>
        </div>
    </div>
</div>
@endsection