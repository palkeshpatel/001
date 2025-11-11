@php
    use Illuminate\Support\Facades\Storage;
@endphp

@forelse ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>
            @if ($user->avatar_path)
                <img src="{{ Storage::url($user->avatar_path) }}" alt="{{ $user->name }}" class="rounded-circle"
                    width="48" height="48">
            @else
                <span class="text-muted">No image</span>
            @endif
        </td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <div class="d-flex align-items-center gap-2">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input status-toggle" type="checkbox" role="switch"
                        data-url="{{ route('users.toggle-status', $user) }}" {{ $user->status ? 'checked' : '' }}>
                </div>
                <span
                    class="badge rounded-pill status-badge {{ $user->status ? 'bg-success' : 'bg-secondary' }}">{{ $user->status ? 'Active' : 'Inactive' }}</span>
            </div>
        </td>
        <td class="text-end">
            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-secondary">View</a>
            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline"
                onsubmit="return confirm('Delete this user?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center text-muted py-4">No users found.</td>
    </tr>
@endforelse
