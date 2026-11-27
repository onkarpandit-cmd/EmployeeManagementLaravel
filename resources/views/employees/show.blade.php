
@extends('layouts.app')

@section('title', 'Employee Details')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">Employee Details</h2>
        <p class="text-secondary">View complete employee information.</p>
    </div>

    <a href="/employees" class="btn btn-secondary">
        Back to Employees
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <h5 class="mb-4">Employee Information</h5>

        <p><strong>ID:</strong> {{ $employee->id }}</p>
        <p><strong>Name:</strong> {{ $employee->name }}</p>
        <p><strong>Email:</strong> {{ $employee->email }}</p>
        <p><strong>Phone:</strong> {{ $employee->phone }}</p>
        <p><strong>Department:</strong> {{ $employee->department }}</p>
        <p><strong>Joining Date:</strong> {{ $employee->joining_date }}</p>

    </div>
</div>

@endsection
