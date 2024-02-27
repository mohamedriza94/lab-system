@extends('doctor.layout.layout')

@section('contents')
<div class="container-fluid">
    {{-- Add Test Form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <h4 class="card-title">Add Test</h4>
                    <form method="post" action="{{ route('doctor.appointments.test.store') }}">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="appointment_id" value="{{ $appointmentData->appointments_id ?? '' }}">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="patient_name" name="patient_name" value="{{ $appointmentData->patient_name ?? '' }}" readonly>
                                    <label for="patient_name">Patient Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="patient_email" name="patient_email" value="{{ $appointmentData->patient_email ?? '' }}" readonly>
                                    <label for="patient_email">Patient Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="test_type_id" name="test_type_id">
                                        <option value="">Select Test Type</option>
                                        @if(isset($testTypes) && !empty($testTypes))
                                        @foreach ($testTypes as $testType)
                                        <option value="{{ $testType->id }}">{{ $testType->name }}</option>
                                        @endforeach
                                        @else
                                        <option value="" disabled>No test types available</option>
                                        @endif
                                    </select>
                                    <label for="test_type_id">Test Type</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="test_result" name="test_result">
                                        <option value="">Select Test Result</option>
                                        <option value="success">Success</option>
                                        <option value="failure">Failure</option>
                                    </select>
                                    <label for="test_result">Test Result</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="test_notes" name="test_notes" rows="3"></textarea>
                                    <label for="test_notes">Test Notes</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="ms-auto mt-3 mt-md-0">
                                    <button type="submit" class="btn btn-primary text-white">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Appointment table --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Assignments</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Patient Name</th>
                                    <th>Patient Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignements as $appointment)
                                <tr>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->start_time }}</td>
                                    <td>{{ $appointment->end_time }}</td>
                                    <td>{{ $appointment->patient_name }}</td>
                                    <td>{{ $appointment->patient_email }}</td>
                                    <td>
                                        @if($appointment->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($appointment->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('doctor.appointments.test', ['id' => $appointment->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-info">Test</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
