@extends('layouts.app')

@section('title', 'Manage Vaccines')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="fas fa-vial me-2"></i>Manage Vaccines</h2>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 text-end">
            <a href="{{ route('admin.vaccines.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-1"></i> Add Vaccine
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Vaccines List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Manufacturer</th>
                                    <th>Doses Required</th>
                                    <th>Days Between Doses</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vaccines as $vaccine)
                                <tr>
                                    <td>{{ $vaccine->id }}</td>
                                    <td>{{ $vaccine->name }}</td>
                                    <td>{{ $vaccine->manufacturer }}</td>
                                    <td>{{ $vaccine->doses_required }}</td>
                                    <td>{{ $vaccine->days_between_doses }}</td>
                                    <td>
                                        @if($vaccine->is_active)
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.vaccines.edit', $vaccine->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.vaccines.destroy', $vaccine->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this vaccine?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No vaccines found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection