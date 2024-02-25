<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function viewAllPatients()
    {
        $patients = DB::table('patients')
        ->select('patients.*', 'latest_available_time.date', 'latest_available_time.start_time', 'latest_available_time.end_time')
        ->leftJoin(DB::raw('(SELECT p.id AS patient_id, at.date, at.start_time, at.end_time
        FROM patients p
        LEFT JOIN available_times at ON p.id = at.patient_id
        ORDER BY at.date DESC, at.start_time DESC
        LIMIT 1) AS latest_available_time'), 'patients.id', '=', 'latest_available_time.patient_id')
        ->orderBy('patients.id', 'desc')
        ->get();

        return view('administrator.patients', compact('patients'));
    }
}
