@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Employees</h4>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-2 mb-3">
                <div class="col-md-4">
                    <input type="text" id="employee-search" class="form-control" placeholder="Search employees..."
                        value="{{ request('search', '') }}">
                </div>
                <div class="col-md-4">
                    @php
                        $employeeSortBy = request('sort_by', 'created_at');
                    @endphp
                    <select id="employee-sort-by" class="form-select">
                        <option value="created_at" @selected($employeeSortBy === 'created_at')>Newest</option>
                        <option value="name" @selected($employeeSortBy === 'name')>Name</option>
                        <option value="email" @selected($employeeSortBy === 'email')>Email</option>
                        <option value="phone" @selected($employeeSortBy === 'phone')>Phone</option>
                        <option value="position" @selected($employeeSortBy === 'position')>Position</option>
                        <option value="status" @selected($employeeSortBy === 'status')>Status</option>
                    </select>
                </div>
                <div class="col-md-4">
                    @php
                        $employeeSortDirection = request('sort_direction', 'desc');
                    @endphp
                    <select id="employee-sort-direction" class="form-select">
                        <option value="desc" @selected($employeeSortDirection === 'desc')>Descending</option>
                        <option value="asc" @selected($employeeSortDirection === 'asc')>Ascending</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Position</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="employees-table-body">
                        @include('employees.partials.rows', ['employees' => $employees])
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer" id="employees-pagination">
            @include('employees.partials.pagination', ['employees' => $employees])
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initAsyncTable({
                endpoint: '{{ route('employees.index') }}',
                tableBodyId: 'employees-table-body',
                paginationId: 'employees-pagination',
                searchInputId: 'employee-search',
                sortBySelectId: 'employee-sort-by',
                sortDirectionSelectId: 'employee-sort-direction',
            });
        });
    </script>
@endpush
