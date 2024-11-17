@extends('layouts.base')
@section('title', 'Add District')
@section('content')
    <div class="card">
    <div class="card-header bg-primary text-info">
            <p class="text-white">Add District</p>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('districts.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">District Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="branch_id">Branch</label>
                    <select name="branch_id" id="branch_id" class="form-control" required>
                        <option value="" disabled selected>Select Branch</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ ucfirst($branch->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-sm mt-3">Add District</button>
            </form>
        </div>
    </div>
@endsection

