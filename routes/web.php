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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewUserListController;
use App\Http\Controllers\PersonResetListController;
use App\Models\User;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\UserProfileController;




Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return "Welcome, Admin!";
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin,representative,tehama'])->group(function () {
    Route::get('/representative/dashboard', function () {
        return "Welcome, Admin or Representative!";
    })->name('representative.dashboard');
    
});






Route::middleware(['auth', 'role:admin'])->group(function () {
    // Branch Routes
    Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');

    // District Routes
    Route::get('/districts/create', [DistrictController::class, 'create'])->name('districts.create');
    Route::post('/districts', [DistrictController::class, 'store'])->name('districts.store');

    // Role Routes
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');

    // Post Routes
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // User Routes
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    // Employee Routes
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

    // Payroll Routes
    Route::get('/payrolls/create', [PayrollController::class, 'create'])->name('payrolls.create');
    Route::post('/payrolls', [PayrollController::class, 'store'])->name('payrolls.store');

    // Payroll Import Route
    Route::post('payroll/import', [PayrollController::class, 'import'])->name('payrolls.import');
});

Route::middleware(['auth', 'role:admin,representative,tehama'])->group(function () {
    // Person Routes
    Route::get('/persons/create', [PersonController::class, 'create'])->name('persons.create');
    Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');

    // Person Reset Routes
    Route::get('/person-resets/create', [PersonResetController::class, 'create'])->name('personResets.create');
    Route::post('/person-resets', [PersonResetController::class, 'store'])->name('personResets.store');

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Person List Routes
    Route::get('/persons', [NewUserListController::class, 'index'])->name('persons.index');
    Route::post('/persons/toggle-status/{id}', [NewUserListController::class, 'toggleStatus'])->name('persons.toggleStatus');

    // Person Reset List Routes
    Route::get('/person-resets', [PersonResetListController::class, 'index'])->name('personResets.index');
    Route::post('/person-resets/toggle-status/{id}', [PersonResetListController::class, 'toggleStatus'])->name('personResets.toggleStatus');

    // Fetch Details
    Route::get('/personResets/{id}', [PersonResetListController::class, 'show'])->name('personResets.show');
    Route::get('/fetch-employee-details/{userId}', [NewUserListController::class, 'fetchEmployeeDetails'])->name('fetch.employee.details');
    
    //analytics
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

});

Route::middleware(['auth'])->group(function () {
    // Protected User Details Route
    Route::get('/users/{id}', function ($id) {
        $user = User::with('employee.role', 'employee.post', 'employee.district')->findOrFail($id);

        return response()->json([
            'user' => $user,
            'employee' => $user->employee,
        ]);
    });
});

Route::middleware(['guest'])->group(function () {
    // Authentication Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


 

 

 

 



Route::middleware('auth')->group(function () {
    // Route to view the profile page
    Route::get('/profile', [UserProfileController::class, 'profile'])->name('profile');

    // Route to update the password
    Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('password.update');
});
