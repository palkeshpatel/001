@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Users</h4>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="text" id="user-search" class="form-control" placeholder="Search users..."
                        value="{{ request('search', '') }}">
                </div>
                <div class="col-md-4">
                    <select id="user-sort-by" class="form-select">
                        @php
                            $userSortBy = request('sort_by', 'created_at');
                        @endphp
                        <option value="created_at" @selected($userSortBy === 'created_at')>Newest</option>
                        <option value="name" @selected($userSortBy === 'name')>Name</option>
                        <option value="email" @selected($userSortBy === 'email')>Email</option>
                        <option value="status" @selected($userSortBy === 'status')>Status</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select id="user-sort-direction" class="form-select">
                        @php
                            $userSortDirection = request('sort_direction', 'desc');
                        @endphp
                        <option value="desc" @selected($userSortDirection === 'desc')>Descending</option>
                        <option value="asc" @selected($userSortDirection === 'asc')>Ascending</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="users-table-body">
                        @include('users.partials.rows', ['users' => $users])
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer" id="users-pagination">
            @include('users.partials.pagination', ['users' => $users])
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initAsyncTable({
                endpoint: '{{ route('users.index') }}',
                tableBodyId: 'users-table-body',
                paginationId: 'users-pagination',
                searchInputId: 'user-search',
                sortBySelectId: 'user-sort-by',
                sortDirectionSelectId: 'user-sort-direction',
            });
        });
    </script>
@endpush
