@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User Details</h5>
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">Back</a>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if ($user->avatar_path)
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($user->avatar_path) }}"
                                alt="{{ $user->name }}" class="rounded-circle mb-3" width="120" height="120">
                        @else
                            <div class="text-muted mb-3">No avatar uploaded</div>
                        @endif
                    </div>
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted mb-4">{{ $user->email }}</p>
                    <p class="small text-muted">Joined on {{ $user->created_at->format('d M Y') }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                            onsubmit="return confirm('Delete this user?')">
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


