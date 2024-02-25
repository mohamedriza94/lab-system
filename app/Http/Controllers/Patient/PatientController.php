<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required','unique:patients','email'],
            'name' => ['required'],
            'nic' => ['required','unique:patients','digits_between:9,10'],
            'dateOfBirth' => ['required', 'date'],
            'password' => ['required'],
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            // Calculate age from date of birth
            $dateOfBirth = $request->input('dateOfBirth');
            $age = date_diff(date_create($dateOfBirth), date_create('now'))->y;

            $patient = new Patient();
            $patient->email = $request->input('email');
            $patient->name = $request->input('name');
            $patient->nic = $request->input('nic');
            $patient->age = $age; // Assign calculated age
            $patient->dateOfBirth = $dateOfBirth;
            $patient->password = Hash::make($request->input('password')); // Hash the password

            $patient->save();

            return redirect()->route('patient.register')->with('success', 'Patient registered successfully!');
        }
    }
}
