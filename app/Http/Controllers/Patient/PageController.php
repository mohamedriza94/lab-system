<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function dashboard(){
        return view('patient.dashboard');
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
