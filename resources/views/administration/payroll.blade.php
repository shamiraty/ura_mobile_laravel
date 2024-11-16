@extends('layouts.base')
@section('title', 'Add Payroll')
@section('content')

<!-- Row to Split the Forms into Left and Right -->
<div class="row mt-3">
@if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
    <!-- Left Column: Manual Payroll Creation Form -->
    <div class="col-md-6">
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                Manual Payroll Creation
            </div>
            <div class="card-body">
                <form action="{{ route('payrolls.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="department">Department</label>
                        <input type="text" name="department" id="department" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="checkNumber">Check Number</label>
                        <input type="text" name="checkNumber" id="checkNumber" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mname">Middle Name</label>
                        <input type="text" name="mname" id="mname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="bankName">Bank Name</label>
                        <input type="text" name="bankName" id="bankName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="accountNumber">Account Number</label>
                        <input type="text" name="accountNumber" id="accountNumber" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="grossAmount">Gross Amount</label>
                        <input type="number" name="grossAmount" id="grossAmount" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="basicSalary">Basic Salary</label>
                        <input type="number" name="basicSalary" id="basicSalary" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="netAmount">Net Amount</label>
                        <input type="number" name="netAmount" id="netAmount" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Add Payroll</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Import Payroll Data Form -->
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header bg-success text-white">
                Import Payroll Data (CSV or Excel)
            </div>
            <div class="card-body">
                <form action="{{ route('payrolls.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="excel_file">Import Payroll Data (CSV, XLS, XLSX)</label>
                        <input type="file" name="excel_file" id="excel_file" class="form-control form-control-lg" accept=".csv,.xls,.xlsx" required>
                        <small class="text-muted">Upload a CSV or Excel file to import multiple payroll records.</small>
                    </div>
                    <button type="submit" class="btn btn-success btn-block mt-3 btn-sm">Import Payroll Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
