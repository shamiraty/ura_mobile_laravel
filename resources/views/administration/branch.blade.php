@extends('layouts.base')
@section('title', 'Add Branch')
@section('content')
    <div class="card">
    <div class="card-header bg-primary text-info">
            <p class="text-white">Add Branch</p>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('branches.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Branch Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3 btn-sm">Add Branch</button>
            </form>
        </div>
    </div>
    
@endsection
