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
}
