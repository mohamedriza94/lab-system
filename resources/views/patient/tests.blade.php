@extends('patient.layout.layout')

@section('contents')
<div class="container-fluid">

    {{-- Tests table --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tests</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Test ID</th>
                                    <th>Appointment ID</th>
                                    <th>Patient Name</th>
                                    <th>Patient Email</th>
                                    <th>Test Type</th>
                                    <th>Test Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tests as $test)
                                <tr>
                                    <td>{{ $test->id }}</td>
                                    <td>{{ $test->appointment_id}}</td>
                                    <td>{{ $test->patient_name }}</td>
                                    <td>{{ $test->patient_email }}</td>
                                    <td>{{ $test->test_type_name }}</td>
                                    <td>{{ $test->result }}</td>
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
