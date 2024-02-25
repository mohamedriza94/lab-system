<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class DoctorController extends Controller
{
    public function addDoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:doctors'],
            'name' => ['required'],
            'nic' => ['required', 'unique:doctors'],
            'dateOfBirth' => ['required', 'date'],
            'specializedIn' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate random password
        $password = rand(100000, 999999);

        // Calculate age from date of birth
        $dateOfBirth = $request->input('dateOfBirth');
        $age = date_diff(date_create($dateOfBirth), date_create('now'))->y;

        $doctor = new Doctor();
        $doctor->email = $request->input('email');
        $doctor->name = $request->input('name');
        $doctor->nic = $request->input('nic');
        $doctor->age = $age;
        $doctor->dateOfBirth = $dateOfBirth;
        $doctor->specializedIn = $request->input('specializedIn');
        $doctor->password = Hash::make($password); // Hash the password
        $doctor->save();

        //Mailing Credentials
        // $data["email"] = $request->input('email');
        // $data["title"] = "Lab Doctor Credentials";
        // $data["password"] = $password;

        // Mail::send('mail.doctorCredentials', $data, function($message)use($data) {
        //     $message->to($data["email"], $data["email"])
        //     ->subject($data["title"]);
        // });


        return redirect()->route('administrator.doctors')->with('success', 'Doctor added successfully.');
    }

    public function viewAllDoctors()
    {
        $doctors = Doctor::orderBy('id', 'desc')->get();
        return view('administrator.doctor', compact('doctors'));
    }

    public function viewDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctors = Doctor::orderBy('id', 'desc')->get();
        return view('administrator.doctor', compact('doctor', 'doctors'));
    }

    public function updateDoctor(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:doctors,email,' . $id],
            'name' => ['required'],
            'nic' => ['required', 'unique:doctors,nic,' . $id],
            'dateOfBirth' => ['required', 'date'],
            'specializedIn' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Calculate age from date of birth
        $dateOfBirth = $request->input('dateOfBirth');
        $age = date_diff(date_create($dateOfBirth), date_create('now'))->y;

        $doctor = Doctor::findOrFail($id);
        $doctor->email = $request->input('email');
        $doctor->name = $request->input('name');
        $doctor->nic = $request->input('nic');
        $doctor->age = $age;
        $doctor->dateOfBirth = $dateOfBirth;
        $doctor->specializedIn = $request->input('specializedIn');
        $doctor->save();

        return redirect()->route('administrator.doctors')->with('success', 'Doctor updated successfully.');
    }

    public function deleteDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect()->route('administrator.doctors')->with('success', 'Doctor deleted successfully.');
    }
}
