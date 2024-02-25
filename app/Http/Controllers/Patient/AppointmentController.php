<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AvailableTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function bookAppointment(Request $request)
    {
        // Validate request data
        $request->validate([
            'available_time_id' => 'required|exists:available_times,id',
            'note' => 'nullable|string|max:255',
        ]);

        $patient = Auth::guard('patient')->user();

        // Find the chosen available time
        $availableTime = AvailableTime::findOrFail($request->available_time_id);

        // Check if the chosen available time's capacity is greater than 0 and status is available
        if ($availableTime->capacity > 0 && $availableTime->status === 'available') {
            // Proceed to book the appointment

            // Reduce the capacity of the available time
            $availableTime->capacity--;
            $availableTime->save();

            // Create a new appointment
            $appointment = new Appointment();
            $appointment->patient_id = $patient->id;
            $appointment->available_time_id = $request->available_time_id;
            $appointment->note = $request->note;
            $appointment->status = 'pending';
            $appointment->save();

            return redirect()->back()->with('success', 'Appointment booked successfully!');
        } else {
            return redirect()->back()->with('error', 'The chosen available time is not available for booking.');
        }
    }

    public function cancelAppointment($id)
    {
        // Find the appointment by ID
        $appointment = Appointment::findOrFail($id);

        // Delete the appointment
        $appointment->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Appointment canceled successfully!');
    }


    public function viewAppointments()
    {
        // Get the authenticated patient's appointments with associated details
        $patient = Auth::guard('patient')->user();
        $appointments = DB::table('appointments')
        ->select('appointments.*', 'available_times.date', 'available_times.start_time', 'available_times.end_time', 'doctors.name as doctor_name')
        ->join('available_times', 'appointments.available_time_id', '=', 'available_times.id')
        ->leftJoin('doctors', 'appointments.doctor_id', '=', 'doctors.id')
        ->where('appointments.patient_id', $patient->id)
        ->get();

        // Load available times that are suitable for booking
        $availableTimes = DB::table('available_times')
        ->where('status', 'available')
        ->where('capacity', '>', 0)
        ->get();

        return view('patient.appointments', compact('appointments', 'availableTimes'));
    }
}
