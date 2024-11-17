@extends('layouts.base')

@section('title', 'New User List')

@section('content')
{{--
<form method="get" class="mb-4">
    <div class="form-row">
        <div class="col-md-12 mb-3">
            <label for="startDate" class="form-label text-light">Filter by Registered Date:</label>
            <div class="input-group">
                <input type="date" id="startDate" name="start_date" class="form-control" value="{{ request('start_date') }}">
                <div class="input-group-append mx-2 text-light">to</div>
                <input type="date" id="endDate" name="end_date" class="form-control" value="{{ request('end_date') }}">
                <button type="submit" class="btn btn-light form-control btn-sm">Apply Filter</button>
            </div>
        </div>
    </div>
</form>
--}}
<div class="alert-section mb-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>

<div class="row gy-4">
    <!-- Total Users Card -->
    <div class="col-xl-3 col-sm-6">
        <div class="card p-2 shadow-sm radius-8 border bg-light">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <span class="mb-0 w-40px h-40px bg-white text-primary d-flex justify-content-center align-items-center rounded-circle">
                            <iconify-icon icon="mdi:database" class="icon"></iconify-icon>  
                        </span>
                        <div>
                            <span class="fw-medium text-secondary text-sm">Total Users</span>
                            <h5 class="fw-semibold text-primary mb-0">{{ $persons->count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Registered Users Card -->
    <div class="col-xl-3 col-sm-6">
        <div class="card p-2 shadow-sm radius-8 border bg-light">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <span class="mb-0 w-40px h-40px bg-white text-primary d-flex justify-content-center align-items-center rounded-circle">
                            <iconify-icon icon="mdi:check-circle" class="icon text-success"></iconify-icon>
                        </span>
                        <div>
                            <span class="fw-medium text-secondary text-sm">Registered Users</span>
                            <h5 class="fw-semibold text-primary mb-0">{{ $persons->where('status', true)->count() }}</h5>
                        </div>
                    </div>
                </div>
          
            </div>
        </div>
    </div>

    <!-- Unregistered Users Card -->
    <div class="col-xl-3 col-sm-6">
        <div class="card p-2 shadow-sm radius-8 border bg-light">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <span class="mb-0 w-40px h-40px bg-white text-primary d-flex justify-content-center align-items-center rounded-circle">
                            <iconify-icon icon="mdi:cancel" class="icon text-danger"></iconify-icon>
                        </span>
                        <div>
                            <span class="fw-medium text-secondary text-sm">Unregistered Users</span>
                            <h5 class="fw-semibold text-primary mb-0">{{ $persons->where('status', false)->count() }}</h5>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>

<div class="card basic-data-table mt-3">
      <div class="card-header bg-info">
      </div>
      <div class="card-body">
<div class="table-responsive">
<table class="table border-primary-table border-2 mb-0 w-100"id="dataTable">
    <thead>
        <tr>
            <th>S/N</th>
            <th>Details</th>
            <th>Check Number</th>
            <th>Simu</th>
            <th>Registered Date</th>
            <th>Name</th>
            <th>Added By</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($persons as $index => $person)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <button class="btn btn btn-outline-primary-600" data-bs-toggle="modal" data-bs-target="#personResetModal" onclick="openPersonResetModal({{ $person->id }})">
                        View Details
                    </button>
                </td>
                <td>{{ $person->check_number }}</td>
                <td>{{ $person->simu ?? 'N/A' }}</td>
                <td>{{ $person->registered_date }}</td>
                <td>{{ $person->payroll->fname ?? 'N/A' }} {{ $person->payroll->mname ?? 'N/A' }} {{ $person->payroll->lname ?? 'N/A' }}</td>
                <td><button 
    type="button" 
    class="btn btn-outline-primary-600" 
    data-bs-toggle="modal" 
    data-bs-target="#employeeDetailsModal" 
    onclick="fetchEmployeeDetails('{{ $person->user_id }}')">
    {{ $person->user->name }}
</button>
</td>              

                <td>
                    <span class="badge text-sm fw-semibold {{ $person->status ? 'bg-success' : 'bg-warning' }} px-20 py-9 radius-4 text-white">
                        {{ $person->status ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <form action="{{ route('persons.toggleStatus', $person->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" 
                class="btn btn-outline-{{ $person->status ? 'danger-600' : 'success-600' }} px-20 d-flex align-items-center btn-sm"
                @if(!auth()->user()->hasAnyRole(['admin', 'tehama'])) disabled @endif>
            <iconify-icon icon="mingcute:square-arrow-{{ $person->status ? 'down' : 'up' }}-line" class="text-xl"></iconify-icon>
            {{ auth()->user()->hasAnyRole(['admin', 'tehama']) ? ($person->status ? 'Deactivate' : 'Activate') : 'No Action' }}
        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

<!-- Modal -->
<div class="modal fade" id="personResetModal" tabindex="-1" aria-labelledby="personResetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-4">
                    <!-- Image Section (Left) -->
                    <div class="col-xl-6">
                        <div class="card radius-12 overflow-hidden h-100 d-flex align-items-center flex-nowrap flex-row shadow-2">
                            <div class="d-flex flex-shrink-0 w-100 h-100">
                                <img id="modalImage" class="w-100 h-100 object-fit-cover img-thumbnail" src="" alt="Person Image">
                            </div>
                        </div>
                    </div>
                    <!-- Details Section (Right) -->
                    <div class="col-xl-6">
                        <div class="card radius-12 overflow-hidden h-100 d-flex align-items-center flex-nowrap flex-row-reverse">
                            <div class="card-body p-2 flex-grow-1">
                                <h6 class="card-title text-lg text-primary-light mb-6">User Application Information</h6>
                                <ul class="list-group">
                                    <li class="list-group-item border text-secondary-light p-16 bg-neutral-50 border-bottom-0">
                                        <strong>Check Number:</strong> <span id="modalCheckNumber"></span>
                                    </li>
                                    <li class="list-group-item border text-secondary-light p-16 bg-base border-bottom-0">
                                        <strong>Simu:</strong> <span id="modalSimu"></span>
                                    </li>
                                    <li class="list-group-item border text-secondary-light p-16 bg-neutral-50 border-bottom-0">
                                        <strong>Registered Date:</strong> <span id="modalRegisteredDate"></span>
                                    </li>
                                    <li class="list-group-item border text-secondary-light p-16 bg-base border-bottom-0">
                                        <strong>Added By:</strong> <span id="modalUser"></span>
                                    </li>
                                    <!-- Payroll Details -->
                                    <li class="list-group-item border text-secondary-light p-16 bg-neutral-50 border-bottom-0">
                                        <strong>First Name:</strong> <span id="modalFname"></span>
                                    </li>
                                    <li class="list-group-item border text-secondary-light p-16 bg-base border-bottom-0">
                                        <strong>Middle Name:</strong> <span id="modalMname"></span>
                                    </li>
                                    <li class="list-group-item border text-secondary-light p-16 bg-neutral-50">
                                        <strong>Last Name:</strong> <span id="modalLname"></span>
                                    </li>
                                </ul>
                                <a href="#" id="downloadLink" class="btn btn-primary btn-sm mt-3" download>Download Image</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openPersonResetModal(personId) {
        $.ajax({
            url: '/personResets/' + personId, // Adjust route
            type: 'GET',
            success: function(response) {
                // Populate modal with data
                $('#modalCheckNumber').text(response.check_number);
                $('#modalSimu').text(response.simu ?? 'N/A');
                $('#modalRegisteredDate').text(response.registered_date);
                $('#modalUser').text(response.user.name ?? 'Unknown');
                
                // Set image and download link
                var imageUrl = '{{ asset("storage") }}/' + response.image;
                $('#modalImage').attr('src', imageUrl);
                $('#downloadLink').attr('href', imageUrl); // Set the download link for the image

                // Set payroll details if available
                $('#modalFname').text(response.payroll.first_name ?? 'N/A');
                $('#modalMname').text(response.payroll.middle_name ?? 'N/A');
                $('#modalLname').text(response.payroll.last_name ?? 'N/A');
            },
            error: function() {
                alert('Error fetching data!');
            }
        });
    }
</script>
<div class="modal fade" id="employeeDetailsModal" tabindex="-1" aria-labelledby="employeeDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
         
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="employeeDetailsContent">
                    <!-- Employee details will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
function fetchEmployeeDetails(userId) {
    // Clear previous content
    document.getElementById('employeeDetailsContent').innerHTML = 'Loading...';

    // Fetch data via AJAX
    fetch(`/fetch-employee-details/${userId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('employeeDetailsContent').innerHTML = `<p class="text-danger">${data.error}</p>`;
            } else {
                // Populate modal with employee data using a table
                document.getElementById('employeeDetailsContent').innerHTML = `
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped border-primary">
                            <thead>
                                <tr>
                                    <th style="text-transform: uppercase;">Field</th>
                                    <th style="text-transform: uppercase;">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>User ID</strong></td>
                                    <td style="text-transform: uppercase;">${data.user_id}</td>
                                </tr>
                                <tr>
                                    <td><strong>Role</strong></td>
                                    <td style="text-transform: uppercase;">${data.role}</td>
                                </tr>
                                <tr>
                                    <td><strong>Post</strong></td>
                                    <td style="text-transform: uppercase;">${data.post}</td>
                                </tr>
                                <tr>
                                    <td><strong>District</strong></td>
                                    <td style="text-transform: uppercase;">${data.district}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td style="text-transform: uppercase;">${data.email}</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone</strong></td>
                                    <td style="text-transform: uppercase;">${data.phone}</td>
                                </tr>
                                <tr>
                                    <td><strong>Force Number</strong></td>
                                    <td style="text-transform: uppercase;">${data.force_number}</td>
                                </tr>
                                <tr>
                                    <td><strong>Rank</strong></td>
                                    <td style="text-transform: uppercase;">${data.rank}</td>
                                </tr>
                                <tr>
                                    <td><strong>Registered Date</strong></td>
                                    <td style="text-transform: uppercase;">${data.registered_date}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;
            }
        })
        .catch(error => {
            document.getElementById('employeeDetailsContent').innerHTML = '<p class="text-danger">An error occurred. Please try again.</p>';
            console.error('Error fetching employee details:', error);
        });
}
</script>