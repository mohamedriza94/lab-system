<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{

    public function tests()
    {
        $doctorId = Auth::guard('doctor')->user()->id;
        // Retrieve the tests along with associated appointment, patient, and test type data using joins
        $tests = DB::table('tests')
        ->join('appointments', 'tests.appointment_id', '=', 'appointments.id')
        ->join('patients', 'appointments.patient_id', '=', 'patients.id')
        ->join('test_types', 'tests.test_type_id', '=', 'test_types.id')
        ->select('tests.id', 'tests.result', 'appointments.id as appointment_id',
        'appointments.created_at',
        'patients.name as patient_name', 'patients.email as patient_email',
        'test_types.name as test_type_name')
        ->where('appointments.doctor_id',$doctorId)
        ->get();

        return view('doctor.tests', compact('tests'));
    }
}
