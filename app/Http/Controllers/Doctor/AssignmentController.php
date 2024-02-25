<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function getAssignments()
    {
        // Get the authenticated doctor's ID
        $doctorId = Auth::guard('doctor')->user()->id;

        // Retrieve appointments for the authenticated doctor
        $assignements = DB::table('appointments')
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
            ->get();

        return view('doctor.assignements', compact('assignements'));
    }
}
