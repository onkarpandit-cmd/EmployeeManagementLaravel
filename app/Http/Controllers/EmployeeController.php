<?php



//use App\Models\Department;

namespace App\Http\Controllers;
use App\Models\Department;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Display all employees
  
public function index(Request $request)
{
    $search = $request->input('search');
    $department = $request->input('department');

    $employees = Employee::with('departmentInfo')
    ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%");

            if (is_numeric($search)) {
                $q->orWhere('id', $search);
            }
        });
    })
    ->when($department, function ($query) use ($department) {
        $query->whereHas('departmentInfo', function ($q) use ($department) {
            $q->where('name', $department);
        });
    })
    ->paginate(5)
    ->withQueryString();

    $totalEmployees = Employee::count();

$itEmployees = Employee::where('department', 'IT')->count();

$hrEmployees = Employee::where('department', 'HR')->count();

$financeEmployees = Employee::where('department', 'Finance')->count();

    return view('employees.index', compact(
    'employees',
    'search',
    'department',
    'totalEmployees',
    'itEmployees',
    'hrEmployees',
    'financeEmployees'
));
}


    // Store a new employee
   public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email',
        'phone' => 'nullable|string|max:20',
        'department_id' => 'required|exists:departments,id',
        'joining_date' => 'required|date',
    ]);

    Employee::create($validated);

    return redirect()
        ->route('employees.index')
        ->with('success', 'Employee added successfully!');
}
// Display a single employee take us show.blade page 
public function show($id)
{
    $employee = Employee::findOrFail($id);

    return view('employees.show', compact('employee'));
}

// Display edit form
public function edit($id)
{
    $employee = Employee::findOrFail($id);

    return view('employees.edit', compact('employee'));
}

// Update employee
public function update(Request $request, $id)
{
    $employee = Employee::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees,email,' . $id,
        'phone' => 'nullable|string|max:20',
        'department' => 'required|string',
        'joining_date' => 'required|date',
    ]);

    $employee->update($validated);

    return redirect('/employees')
        ->with('success', 'Employee updated successfully!');
}

// Delete an employee
public function destroy($id)
{
    $employee = Employee::findOrFail($id);

    $employee->delete();

    return redirect('/employees')
        ->with('success', 'Employee deleted successfully!');
}



public function create()
{
    $departments = Department::all();

    return view('employees.create', compact('departments'));
}

}
