@extends('layouts.base')

@section('content')
    <h1>Employee Details</h1>
    <div class="card">
        <div class="card-body">
            <h5>Role: {{ $employee->role->name }}</h5>
            <p>Post: {{ $employee->post->name }}</p>
            <p>District: {{ $employee->district->name }}</p>
            <p>Force Number: {{ $employee->force_number }}</p>
            <p>Rank: {{ $employee->rank }}</p>
        </div>
    </div>
@endsection
