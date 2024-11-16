@extends('layouts.base')

@section('title', 'Add Person')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Add Person</h3>
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

            <form action="{{ route('persons.store') }}" method="POST" enctype="multipart/form-data">
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

                <!-- Removed status field, no longer required in the form -->

                <button type="submit" class="btn btn-primary">Add Person</button>
            </form>
        </div>
    </div>
@endsection
