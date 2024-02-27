@extends('administrator.layout.layout')

@section('contents')
<div class="container-fluid">
    {{-- Total Patients --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Patients</h5>
                    <p class="card-text">{{ \App\Models\Patient::count() }}</p>
                </div>
            </div>
        </div>

        {{-- Total Appointments --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Appointments</h5>
                    <p class="card-text">{{ \App\Models\Appointment::count() }}</p>
                </div>
            </div>
        </div>

        {{-- Total Doctors --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Doctors</h5>
                    <p class="card-text">{{ \App\Models\Doctor::count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
