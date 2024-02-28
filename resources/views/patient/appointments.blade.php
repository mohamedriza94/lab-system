@extends('patient.layout.layout')

@section('contents')
<div class="container-fluid">
    {{-- Book Appointment form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Book Appointment</h4>
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
                    <form id="appointmentForm" method="post" action="{{ route('patient.appointments.book') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="available_time_id" name="available_time_id">
                                        @foreach($availableTimes as $availableTime)
                                        <option value="{{ $availableTime->id }}">{{ $availableTime->date }} - {{ $availableTime->start_time }} to {{ $availableTime->end_time }}</option>
                                        @endforeach
                                    </select>
                                    <label for="available_time_id">Select Available Time</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="note" name="note" value="{{ old('note') }}">
                                    <label for="note">Note</label>
                                </div>
                            </div>
                            <!-- New Fields for Card Details -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="card_holder_name" name="card_holder_name">
                                    <label for="card_holder_name">Card Holder Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="card_number" name="card_number">
                                    <label for="card_number">Card Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="cvv" name="cvv">
                                    <label for="cvv">CVV</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="expiry_date" name="expiry_date">
                                    <label for="expiry_date">Expiry Date (MM/YYYY)</label>
                                </div>
                            </div>
                            <!-- End of New Fields -->
                            <!-- Display Total Payable -->
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="total_payable" name="total_payable" value="1000" readonly>
                                    <label for="total_payable">Total Payable (LKR)</label>
                                </div>
                            </div>
                            <!-- End of Total Payable -->
                            <div class="col-12">
                                <div class="ms-auto mt-3 mt-md-0">
                                    <button type="submit" class="btn btn-primary text-white">Book Appointment</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @php
    // PHP function to generate random price in thousands LKR
    function generateRandomPrice() {
        return rand(10, 100) * 1000;
    }
    @endphp


    {{-- Appointment table --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Appointments</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Status</th>
                                    <th>Doctor</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->start_time }}</td>
                                    <td>{{ $appointment->end_time }}</td>
                                    <td>
                                        @if($appointment->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($appointment->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                        @endif
                                    </td>
                                    <td>{{ $appointment->doctor_name ?? 'NOT ASSIGNED' }}</td>
                                    <td>
                                        <form action="{{ route('patient.appointments.cancel', ['id' => $appointment->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
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
<script>
    // JavaScript Validation Functions
    function validateCardDetails() {
        // You can implement your validation logic here
        // For simplicity, let's assume all fields are required
        var cardHolderName = document.getElementById('card_holder_name').value;
        var cardNumber = document.getElementById('card_number').value;
        var cvv = document.getElementById('cvv').value;
        var expiryDate = document.getElementById('expiry_date').value;

        if (cardHolderName.trim() === '' || cardNumber.trim() === '' || cvv.trim() === '' || expiryDate.trim() === '') {
            alert('All card details are required.');
            return false;
        }

        // You can add more validation rules as per your requirement

        return true;
    }

    // Event listener for form submission
    document.getElementById('appointmentForm').addEventListener('submit', function (event) {
        if (!validateCardDetails()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
</script>
@endsection
