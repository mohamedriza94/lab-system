<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function dashboard(){

        // Get the authenticated patient's ID
        $patientId = Auth::guard('patient')->user()->id;

        // Retrieve the report data using join queries
        $report = DB::table('appointments')
            ->select(
                'patients.name as patient_name',
                'patients.email as patient_email',
                'patients.age as patient_age',
                'appointments.id as appointment_id',
                'appointments.created_at as appointment_created_at',
                'doctors.name as doctor_name',
                'tests.id as test_id',
                'test_types.name as test_type_name',
                'tests.result as test_result'
            )
            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
            ->leftJoin('tests', 'appointments.id', '=', 'tests.appointment_id')
            ->leftJoin('test_types', 'tests.test_type_id', '=', 'test_types.id')
            ->where('appointments.patient_id', $patientId)
            ->get();

            $groupedReport = [];
        foreach ($report as $appointment) {
            $doctorName = $appointment->doctor_name;
            if (!isset($groupedReport[$doctorName])) {
                $groupedReport[$doctorName] = [];
            }
            $groupedReport[$doctorName][] = $appointment;
        }

            // dd($groupedReport);

        return view('patient.dashboard', compact('groupedReport'));
    }
    public function register(){
        return view('patient.register');
    }
    public function appointment(){
        return view('patient.appointment');
    }
    public function test(){
        return view('patient.test');
    }
}
