<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function viewAllPatients()
    {
        $patients = DB::table('patients')
            ->leftJoin('appointments', 'patients.id', '=', 'appointments.patient_id')
            ->leftJoin('available_times', 'appointments.available_time_id', '=', 'available_times.id')
            ->select(
                'patients.name',
                'patients.email',
                'patients.age',
                'available_times.date',
                'available_times.start_time',
                'available_times.end_time'
            )
            ->distinct('patients.email') // Select distinct patients based on their ID
            ->orderBy('patients.id', 'desc')
            ->get();

        return view('administrator.patients', compact('patients'));
    }
}
