@extends('administrator.layout.layout')

@section('contents')
<div class="container-fluid">

    {{-- Patient table --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Patients</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>NIC</th>
                                    <th>Age</th>
                                    <th>Date of Birth</th>
                                    <th>Latest Appointment Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patients as $patient)
                                <tr>
                                    <td>{{ $patient->email }}</td>
                                    <td>{{ $patient->name }}</td>
                                    <td>{{ $patient->nic }}</td>
                                    <td>{{ $patient->age }}</td>
                                    <td>{{ $patient->dateOfBirth }}</td>
                                    <td>{{ $patient->date }}</td>
                                    <td>{{ $patient->start_time }}</td>
                                    <td>{{ $patient->end_time }}</td>
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
