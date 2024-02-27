@extends('doctor.layout.layout')

@section('contents')
<div class="container-fluid">
    {{-- Total Appointments --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Appointments</h5>
                    <p class="card-text">@php echo App\Models\Appointment::where('doctor_id', Auth::guard('doctor')->user()->id)->count(); @endphp</p>
                </div>
            </div>
        </div>

        {{-- Total Tests --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Tests</h5>
                    <p class="card-text">@php echo App\Models\Test::whereHas('appointment', function($query) {
                        $query->where('doctor_id', Auth::guard('doctor')->user()->id);
                    })->count(); @endphp</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
