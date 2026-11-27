
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

// Home Route
Route::get('/', function () {
    return redirect()->route('login');
});

// Login Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Employee Routes
Route::middleware('auth')->group(function () {

    Route::get('/employees', [EmployeeController::class, 'index'])
        ->name('employees.index');

    Route::post('/employees', [EmployeeController::class, 'store'])
        ->name('employees.store');

    Route::get('/employees/create', [EmployeeController::class, 'create'])
        ->name('employees.create');

    Route::get('/employees/{id}', [EmployeeController::class, 'show'])
        ->name('employees.show');

    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])
        ->name('employees.edit');

    Route::put('/employees/{id}', [EmployeeController::class, 'update'])
        ->name('employees.update');

    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])
        ->name('employees.destroy');
});
