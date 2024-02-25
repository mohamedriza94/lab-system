@extends('administrator.layout.layout')

@section('contents')
<div class="container-fluid">
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
