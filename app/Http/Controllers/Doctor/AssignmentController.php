<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{

    private function getDoctorAppointmentData()
    {
        // Get the authenticated doctor's ID
        $doctorId = Auth::guard('doctor')->user()->id;

        // Retrieve appointments for the authenticated doctor
        return DB::table('appointments')
            ->select(
                'appointments.*',
                'patients.name as patient_name',
                'patients.email as patient_email',
                'available_times.date',
                'available_times.start_time',
                'available_times.end_time',
            )
            ->leftJoin('patients', 'appointments.patient_id', '=', 'patients.id')
            ->leftJoin('available_times', 'appointments.available_time_id', '=', 'available_times.id')
            ->where('appointments.doctor_id', $doctorId)
            ->where('appointments.status', 'pending')
            ->get();
    }

    public function getAssignments()
    {
        $assignements = $this->getDoctorAppointmentData();

        return view('doctor.assignements', compact('assignements'));
    }

    public function viewAppointmentTest($id)
    {
        $assignements = $this->getDoctorAppointmentData();
        // Get appointment data and associated patient data using joins
        $appointmentData = DB::table('appointments')
            ->select(
                'appointments.*',
                'patients.name as patient_name',
                'patients.email as patient_email',
                'appointments.id as appointments_id'
            )
            ->leftJoin('patients', 'appointments.patient_id', '=', 'patients.id')
            ->where('appointments.id', $id)
            ->first();

        // Get test types
        $testTypes = DB::table('test_types')->get();

        // Redirect to doctor.assignments route with appointment data and test types
        return view('doctor.assignements')->with(compact('assignements', 'appointmentData', 'testTypes'));
    }

    public function storeTest(Request $request)
    {
        // Validate request data
        $request->validate([
            'test_type_id' => 'required|exists:test_types,id',
            'test_result' => 'required|in:success,failure',
            'test_notes' => 'nullable|string|max:255',
        ]);

        // Create a new test
        $test = new Test();
        $test->appointment_id = $request->appointment_id;
        $test->test_type_id = $request->test_type_id;
        $test->result = $request->test_result;
        $test->notes = $request->test_notes;
        $test->save();

        return redirect()->route('doctor.assignments')->with('success', 'Test Recorded Successfully!');
    }
}
