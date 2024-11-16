@extends('layouts.base')
@section('title', 'Add Employee')
@section('content')


    <div class="card">
        <div class="card-header">
            <h6>Add Employee</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_id">User</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Select User</option>
                        @foreach(App\Models\User::all() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="role_id">Role</label>
                    <select name="role_id" id="role_id" class="form-control" required>
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="post_id">Post</label>
                    <select name="post_id" id="post_id" class="form-control" required>
                        <option value="">Select Post</option>
                        @foreach($posts as $post)
                            <option value="{{ $post->id }}">{{ $post->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="district_id">District</label>
                    <select name="district_id" id="district_id" class="form-control js-example-basic-single" required>
                        <option value="">Select District</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="force_number">Force Number</label>
                    <input type="text" name="force_number" id="force_number" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="rank">Rank</label>
                    <input type="text" name="rank" id="rank" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-sm mt-3">Add Employee</button>
            </form>
        </div>
    </div>
@endsection
