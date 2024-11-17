@extends('layouts.base') <!-- Assuming base layout is 'app.blade.php' -->

@section('content')
    @section('css')
    @endsection
        <div class="row justify-content-center mb-4 mt-3">
            <!-- Card 1: New User -->
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-lg border-0 rounded-3">
                    <div class="card-header bg-gradient-primary text-primary">
                        <div class="d-flex justify-content-center">
                            <iconify-icon icon="mingcute:user-follow-fill" class="icon display-3"></iconify-icon>
                        </div>
                        <h5 class="mt-2 text-primary">NEW USER</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted">Register for URA Mobile to get started</p>
                        <a href="{{ route('persons.create') }}" class="btn btn-lg btn-outline-primary w-100">
                            Register Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 2: Registered User -->
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-lg border-0 rounded-3">
                    <div class="card-header bg-gradient-success text-success">
                        <div class="d-flex justify-content-center">
                            <iconify-icon icon="mdi:check-circle-outline" class="icon display-3 text-success"></iconify-icon>
                        </div>
                        <h5 class="mt-2 text-success">REGISTERED USER</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted">Request a new PIN or change your phone number</p>
                        <a href="{{ route('personResets.create') }}" class="btn btn-lg btn-outline-success w-100 mb-3">
                            Request New PIN
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 3: Download URA Mobile Form -->
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-lg border-0 rounded-3">
                    <div class="card-header bg-gradient-danger text-warning">
                        <div class="d-flex justify-content-center">
                            <!-- Updated PDF icon -->
                            <iconify-icon icon="ri:file-pdf-line" class="icon display-3"></iconify-icon>
                        </div>
                        <h5 class="mt-2 text-warning">URA MOBILE FORM</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ asset('img/ura_form.pdf') }}" target="_blank" class="btn btn-lg btn-outline-warning w-100 mb-3">
                            Download Form
                        </a>
                        
                        <div class="text-start">
                            <ol class="text-muted">
                                <li><small>Download the form.</small></li>
                                <li><small>Fill out the form.</small></li>
                                <li><small>Capture the form using the phone camera.</small></li>
                                <li><small>Ensure the image is clear.</small></li>
                                <li><small>Make sure the image size is less than 3 MB.</small></li>
                            </ol>
                        </div>        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <!-- Add any custom JavaScript here if needed -->
@endsection
