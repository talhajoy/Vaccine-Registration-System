@extends('layouts.app')

@section('title', 'Manage Centers')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="fas fa-hospital me-2"></i>Manage Vaccine Centers</h2>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 text-end">
            <a href="{{ route('admin.centers.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-1"></i> Add Center
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Centers List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($centers as $center)
                                <tr>
                                    <td>{{ $center->id }}</td>
                                    <td>{{ $center->name }}</td>
                                    <td>{{ $center->address }}</td>
                                    <td>
                                        @if($center->is_active)
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.centers.edit', $center->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.centers.destroy', $center->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this center?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No centers found.</td>
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