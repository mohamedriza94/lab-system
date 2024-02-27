@extends('patient.layout.layout')

@section('contents')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="mb-4">Doctor's Report</h1>
            @foreach($groupedReport as $doctorName => $appointments)
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h2 class="m-0">Doctor {{ $doctorName }}</h2>
                </div>
                <div class="card-body">
                    @foreach($appointments as $appointment)
                    <div class="mb-3 border rounded p-3">
                        <h5 class="mb-2">Patient Details</h5>
                        <p><strong>Name:</strong> {{ $appointment->patient_name }}</p>
                        <p><strong>Email:</strong> {{ $appointment->patient_email }}</p>
                        <p><strong>Age:</strong> {{ $appointment->patient_age }} years</p>
                        <h5 class="mb-2">Appointment Details</h5>
                        <p><strong>ID:</strong> {{ $appointment->appointment_id }}</p>
                        <p><strong>Created At:</strong> {{ $appointment->appointment_created_at }}</p>
                        <h5 class="mb-2">Test Details</h5>
                        @if($appointment->test_id)
                        <p><strong>Test ID:</strong> {{ $appointment->test_id }}</p>
                        <p><strong>Test Type:</strong> {{ $appointment->test_type_name }}</p>
                        <p><strong>Test Result:</strong> {{ $appointment->test_result }}</p>
                        @else
                        <p>No test details available</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
