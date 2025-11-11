@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Employee Details</h5>
                    <a href="{{ route('employees.index') }}" class="btn btn-sm btn-outline-secondary">Back</a>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if ($employee->image_path)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($employee->image_path) }}"
                                alt="{{ $employee->name }}" class="rounded-circle mb-3" width="120" height="120">
                        @else
                            <div class="text-muted mb-3">No photo uploaded</div>
                        @endif
                    </div>
                    <h5 class="mb-1">{{ $employee->name }}</h5>
                    @if ($employee->position)
                        <p class="text-muted mb-1">{{ $employee->position }}</p>
                    @endif
                    <div class="mb-3">
                        <p class="mb-1"><strong>Email:</strong> {{ $employee->email ?? '—' }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $employee->phone ?? '—' }}</p>
                    </div>
                    <p class="small text-muted">Created on {{ $employee->created_at->format('d M Y') }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                            onsubmit="return confirm('Delete this employee?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


