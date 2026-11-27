
@extends('layouts.app')

@section('title', 'Add Employee')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold">Add Employee</h2>
    <p class="text-secondary">Enter employee information below.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

            {{-- Employee Name --}}
            <div class="mb-3">
                <label class="form-label">Employee Name</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Enter employee name"
                    value="{{ old('name') }}"
                >

                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter email address"
                    value="{{ old('email') }}"
                >

                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Phone --}}
            <div class="mb-3">
                <label class="form-label">Phone</label>

                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    placeholder="Enter phone number"
                    value="{{ old('phone') }}"
                >

                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Department --}}
            <div class="mb-3">
                <label class="form-label">Department</label>

                <select name="department_id" class="form-select">

                    <option value="">Select Department</option>

                    @foreach($departments as $department)
                        <option
                            value="{{ $department->id }}"
                            {{ old('department_id') == $department->id ? 'selected' : '' }}
                        >
                            {{ $department->name }}
                        </option>
                    @endforeach

                </select>

                @error('department_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Joining Date --}}
            <div class="mb-4">
                <label class="form-label">Joining Date</label>

                <input
                    type="date"
                    name="joining_date"
                    class="form-control"
                    value="{{ old('joining_date') }}"
                >

                @error('joining_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Buttons --}}
            <button type="submit" class="btn btn-primary">
                Save Employee
            </button>

            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>
</div>

@endsection
