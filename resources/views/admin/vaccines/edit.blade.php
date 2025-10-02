@extends('layouts.app')

@section('title', 'Edit Vaccine')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Vaccine</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.vaccines.update', $vaccine->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $vaccine->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="manufacturer" class="form-label">Manufacturer</label>
                            <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="{{ $vaccine->manufacturer }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ $vaccine->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="doses_required" class="form-label">Doses Required</label>
                            <input type="number" class="form-control" id="doses_required" name="doses_required" value="{{ $vaccine->doses_required }}" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="days_between_doses" class="form-label">Days Between Doses</label>
                            <input type="number" class="form-control" id="days_between_doses" name="days_between_doses" value="{{ $vaccine->days_between_doses }}" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Status</label>
                            <select class="form-select" id="is_active" name="is_active" required>
                                <option value="1" @if($vaccine->is_active) selected @endif>Active</option>
                                <option value="0" @if(!$vaccine->is_active) selected @endif>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Vaccine</button>
                        <a href="{{ route('admin.vaccines.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection