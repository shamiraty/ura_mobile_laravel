@extends('layouts.base')

@section('title', 'Profile')

@section('content')
<div class="container mt-2">
    <div class="row">
        <!-- Employee Information Column (Left) -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <p class="mb-0 text-white">User Information</p>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Name:</strong> 
                            <span class="badge bg-secondary">{{ $user->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Email:</strong> 
                            <span class="badge bg-info">{{ $user->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Role:</strong> 
                            <span class="badge bg-success">{{ $employee ? $employee->role->role : 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Post:</strong> 
                            <span class="badge bg-warning">{{ $employee ? $employee->post->name : 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>District:</strong> 
                            <span class="badge bg-primary">{{ $employee ? $employee->district->name : 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Branch:</strong> 
                            <span class="badge bg-danger">{{ $employee ? $employee->district->branch->name : 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Force Number:</strong> 
                            <span class="badge bg-dark">{{ $employee ? $employee->force_number : 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Phone Number:</strong> 
                            <span class="badge bg-secondary">{{ $employee ? $employee->phone : 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Rank:</strong> 
                            <span class="badge bg-info">{{ $employee ? $employee->rank : 'N/A' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Password Change Form Column (Right) -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <p class="mb-0 text-white">Change Password</>
                </div>
                <div class="card-body">
                    @error('new_password')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        @method('PUT') <!-- This ensures the form is sent as a PUT request -->

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>    
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
