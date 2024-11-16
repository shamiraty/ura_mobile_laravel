<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PersonResetController;



Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');

Route::get('/districts/create', [DistrictController::class, 'create'])->name('districts.create');
Route::post('/districts', [DistrictController::class, 'store'])->name('districts.store');

Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

Route::get('/payrolls/create', [PayrollController::class, 'create'])->name('payrolls.create');
Route::post('/payrolls', [PayrollController::class, 'store'])->name('payrolls.store');

Route::get('/persons/create', [PersonController::class, 'create'])->name('persons.create');
Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');

Route::get('/person-resets/create', [PersonResetController::class, 'create'])->name('personResets.create');
Route::post('/person-resets', [PersonResetController::class, 'store'])->name('personResets.store');



use App\Http\Controllers\AuthController;


// Show login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Handle login submission
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Handle logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// routes/web.php
//Route::put('/update-status/{checkNumber}', [NewUserListController::class, 'updateStatus'])->name('updateStatus');

use App\Http\Controllers\DashboardController ;

// Protect the dashboard route with authentication middleware
Route::get('/dashboard', [DashboardController ::class, 'index'])->name('dashboard');


//payroll import
Route::post('payroll/import', [PayrollController::class, 'import'])->name('payrolls.import');


use App\Http\Controllers\NewUserListController;

Route::get('/persons', [NewUserListController::class, 'index'])->name('persons.index');
Route::post('/persons/toggle-status/{id}', [NewUserListController::class, 'toggleStatus'])->name('persons.toggleStatus');



use App\Http\Controllers\PersonResetListController;

Route::get('/person-resets', [PersonResetListController::class, 'index'])->name('personResets.index');
Route::post('/person-resets/toggle-status/{id}', [PersonResetListController::class, 'toggleStatus'])->name('personResets.toggleStatus');




// Add this route to handle the AJAX request to fetch person reset details
Route::get('/personResets/{id}', [PersonResetListController::class, 'show']);
Route::get('/personResets/{id}', [NewUserListController::class, 'show']);





use App\Models\User;

Route::get('/users/{id}', function($id) {
    $user = User::with('employee.role', 'employee.post', 'employee.district')->findOrFail($id);
    
    // Return data as JSON
    return response()->json([
        'user' => $user,
        'employee' => $user->employee,
    ]);
});

Route::get('/fetch-employee-details/{userId}', [NewUserListController::class, 'fetchEmployeeDetails'])->name('fetch.employee.details');
Route::get('/fetch-employee-details/{userId}', [PersonResetListController::class, 'fetchEmployeeDetails'])->name('fetch.employee.details');




