@extends('layouts.base')

@section('content')

<h6 class="text-center text-primary">Ura Mobile Application Status By Branch</h6>
    <!-- Branch Summary Table -->

    <div class="row">
        <div class="col-md-6">
            <div class="card basic-data-table mt-3 shadow-4">
                <div class="card-header bg-primary text-white">
                    <p class="card-title text-white">New users Applications &  PIN reset Applications</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table border-primary-table mb-0 w-100">
                            <thead>
                                <tr>
                                    <th>Branch</th>
                                    <th>Total Registered Users</th>
                                    <th>Total Unregistered Users</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($branchSummary as $branchName => $statuses)
                                    <tr>
                                        <td>{{ $branchName }}</td>
                                        <td>{{ $statuses['Active'] }}</td>
                                        <td>{{ $statuses['Inactive'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
   

<div class="col-md-6">
    <!-- Overall Summary Card -->
            <div class="card text-center shadow-4 mt-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title text-white">Overall Status Summary</h5>
                </div>
                <div class="card-body">
    <ul class="list-group">
        <li class="list-group-item">
            <p>
                <strong class="text-success">Registered Users:</strong>
                <span class="badge bg-success">{{ $overallSummary['Active'] }}</span>
            </p>
        </li>
        <li class="list-group-item">
            <p>
                <strong class="text-danger">Unregistered Users:</strong>
                <span class="badge bg-danger">{{ $overallSummary['Inactive'] }}</span>
            </p>
        </li>
    </ul>
</div>


            </div>
        </div>
    </div>


    <h6 class="text-center text-primary mt-5">Ura Mobile Application Status By District</h6>
    <div class="row">
        <!-- PersonNew Table -->
        <div class="col-md-6">
            <div class="card basic-data-table mt-3 shadow-4">
                <div class="card-header bg-primary text-white">
                    <p class="card-title text-white">New users Applications</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table border-primary-table mb-0 w-100" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Branch</th>
                                    <th>District</th>
                                    <th>Active</th>
                                    <th>Inactive</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($personNews as $branchName => $districts)
                                    @foreach($districts as $districtName => $statuses)
                                        <tr>
                                            <td>{{ $branchName }}</td>
                                            <td>{{ $districtName }}</td>
                                            <td>{{ $statuses['Active'] ?? 0 }}</td>
                                            <td>{{ $statuses['Inactive'] ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- PersonReset Table -->
        <div class="col-md-6">
            <div class="card basic-data-table mt-3 shadow-4">
                <div class="card-header bg-primary text-white">
                    <p class="card-title text-white">PIN reset Applications</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table border-primary-table mb-0 w-100" id="myTable">
                            <thead>
                                <tr>
                                    <th>Branch</th>
                                    <th>District</th>
                                    <th>Active</th>
                                    <th>Inactive</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($personResets as $branchName => $districts)
                                    @foreach($districts as $districtName => $statuses)
                                        <tr>
                                            <td>{{ $branchName }}</td>
                                            <td>{{ $districtName }}</td>
                                            <td>{{ $statuses['Active'] ?? 0 }}</td>
                                            <td>{{ $statuses['Inactive'] ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
@endsection
