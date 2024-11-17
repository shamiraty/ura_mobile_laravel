@extends('layouts.base')
@section('title', 'Add Role')
@section('content')
    <div class="card">
    <div class="card-header bg-primary text-info">
            <p class="text-white">Add Role</p>
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

            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="role">Role Name</label>
                    <input type="text" name="role" id="role" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-sm mt-3">Add Role</button>
            </form>
        </div>
    </div>
@endsection
