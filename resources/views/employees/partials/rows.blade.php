@php
    use Illuminate\Support\Facades\Storage;
@endphp

@forelse ($employees as $employee)
    <tr>
        <td>{{ $employee->id }}</td>
        <td>
            @if ($employee->image_path)
                <img src="{{ Storage::url($employee->image_path) }}" alt="{{ $employee->name }}" class="rounded-circle"
                    width="48" height="48">
            @else
                <span class="text-muted">No image</span>
            @endif
        </td>
        <td>{{ $employee->name }}</td>
        <td>{{ $employee->email ?? '—' }}</td>
        <td>{{ $employee->phone ?? '—' }}</td>
        <td>{{ $employee->position ?? '—' }}</td>
        <td>
            <div class="d-flex align-items-center gap-2">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                        data-url="{{ route('employees.toggle-status', $employee) }}"
                        {{ $employee->status ? 'checked' : '' }}>
                </div>
                <span
                    class="badge rounded-pill status-badge {{ $employee->status ? 'bg-success' : 'bg-secondary' }}">{{ $employee->status ? 'Active' : 'Inactive' }}</span>
            </div>
        </td>
        <td class="text-end">
            <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-outline-secondary">View</a>
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Delete this employee?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center text-muted py-4">No employees found.</td>
    </tr>
@endforelse

