@extends('layouts.base')
@section('title', 'Add Person Reset')
@section('content')
    <div class="card">
        <div class="card-header">
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

            <form action="{{ route('personResets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="check_number">Check Number</label>
                    <input type="text" name="check_number" id="check_number" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="simu">Simu</label>
                    <input type="text" name="simu" id="simu" class="form-control" required>
                </div>
{{--
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="checkbox" name="status" id="status" class="form-control" value="1">
                    <!-- 1 will be stored as true (enabled) or 0 as false (disabled) -->
                </div>--}}

                <!-- Hidden field for user_id, capturing the logged-in user automatically -->
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                <button type="submit" class="btn btn-primary">Add Person Reset</button>
            </form>
        </div>
    </div>
@endsection
