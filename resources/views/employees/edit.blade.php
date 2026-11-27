
@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold">Edit Employee</h2>
    <p class="text-secondary">Update employee information.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="{{ route('employees.update', $employee->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Employee Name</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name', $employee->name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email', $employee->email) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control"
                       value="{{ old('phone', $employee->phone) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Department</label>
                <select name="department" class="form-select">
                    <option value="IT" {{ old('department', $employee->department) == 'IT' ? 'selected' : '' }}>IT</option>
                    <option value="HR" {{ old('department', $employee->department) == 'HR' ? 'selected' : '' }}>HR</option>
                    <option value="Finance" {{ old('department', $employee->department) == 'Finance' ? 'selected' : '' }}>Finance</option>
                    <option value="Marketing" {{ old('department', $employee->department) == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Joining Date</label>
                <input type="date" name="joining_date"
                       class="form-control"
                       value="{{ old('joining_date', $employee->joining_date) }}">
            </div>

            <button type="submit" class="btn btn-primary">
                Update Employee
            </button>

            <a href="/employees" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>
</div>

@endsection
