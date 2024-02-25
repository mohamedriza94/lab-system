<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function getAppointments()
    {
        $appointments = DB::table('appointments')
            ->select(
                'appointments.*',
                'patients.name as patient_name',
                'patients.email as patient_email',
                'available_times.date',
                'available_times.start_time',
                'available_times.end_time',
                'doctors.name as doctor_name'
            )
            ->leftJoin('patients', 'appointments.patient_id', '=', 'patients.id')
            ->leftJoin('available_times', 'appointments.available_time_id', '=', 'available_times.id')
            ->leftJoin('doctors', 'appointments.doctor_id', '=', 'doctors.id')
            ->get();

        $doctors = Doctor::orderBy('id', 'desc')->get();

        return view('administrator.appointments', compact('appointments', 'doctors'));
    }

    public function assignDoctor(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        // Find the appointment
        $appointment = Appointment::findOrFail($id);

        // Assign the doctor to the appointment
        $appointment->doctor_id = $request->doctor_id;
        $appointment->save();

        // Redirect back with success message
        return redirect()->route('administrator.appointments')->with('success', 'Doctor assigned to appointment successfully!');
    }
}
