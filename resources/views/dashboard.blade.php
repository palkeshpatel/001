@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">Dashboard</h4>
                    <p class="mb-2">Welcome back, {{ auth()->user()->name }}!</p>
                    <p class="text-muted">
                        Use the navigation links above to manage users and employees.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection


