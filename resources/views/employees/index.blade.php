
@extends('layouts.app')

@section('title', 'Employees')

@section('content')

{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Validation Errors --}}
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Employee Management</h2>
        <p class="text-secondary mb-0">Manage your company employees.</p>
    </div>

    <a href="/employees/create" class="btn btn-primary">
        + Add Employee
    </a>
</div>

{{-- Employee Count --}}
{{-- Dashboard Statistics --}}
<div class="row mb-4">

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-secondary">Total Employees</h6>
                <h3 class="fw-bold">{{ $totalEmployees }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-secondary">IT Department</h6>
                <h3 class="fw-bold">{{ $itEmployees }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-secondary">HR Department</h6>
                <h3 class="fw-bold">{{ $hrEmployees }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="text-secondary">Finance Department</h6>
                <h3 class="fw-bold">{{ $financeEmployees }}</h3>
            </div>
        </div>
    </div>

</div>

{{-- Employee List --}}
<div class="card border-0 shadow-sm">

    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Employee List</h5>
    </div>

    <div class="card-body">

        {{-- Search and Department Filter --}}
        <form action="{{ route('employees.index') }}" method="GET" class="mb-4">

            <div class="input-group">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search by ID, name or email..."
                    value="{{ $search ?? '' }}"
                >

                <select name="department" class="form-select">

                    <option value="">All Departments</option>

                    <option value="IT" {{ ($department ?? '') == 'IT' ? 'selected' : '' }}>
                        IT
                    </option>

                    <option value="HR" {{ ($department ?? '') == 'HR' ? 'selected' : '' }}>
                        HR
                    </option>

                    <option value="Finance" {{ ($department ?? '') == 'Finance' ? 'selected' : '' }}>
                        Finance
                    </option>

                    <option value="Marketing" {{ ($department ?? '') == 'Marketing' ? 'selected' : '' }}>
                        Marketing
                    </option>

                </select>

                <button type="submit" class="btn btn-primary">
                    Filter
                </button>

                <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                    Reset
                </a>

            </div>

        </form>

        {{-- Employee Table --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Joining Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($employees as $employee)

                        <tr>
                            <td>{{ $employee->id }}</td>

                            <td class="fw-semibold">
                                {{ $employee->name }}
                            </td>

                            <td>{{ $employee->email }}</td>
                            
                            <td>{{ $employee->phone ?: 'N/A' }}</td>

                            <td>
                                <span class="badge bg-primary">
{{ $employee->departmentInfo->name ?? 'Not Assigned' }}                                </span>
                            </td>

                            <td>{{ $employee->joining_date }}</td>

                            <td>
                                <a href="{{ route('employees.show', $employee->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    View
                                </a>

                                <a href="{{ route('employees.edit', $employee->id) }}"
                                   class="btn btn-sm btn-outline-warning">
                                    Edit
                                </a>

                                <form action="{{ route('employees.destroy', $employee->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this employee?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Delete
                                    </button>

                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center text-secondary py-4">
                                No employees found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $employees->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

@endsection
