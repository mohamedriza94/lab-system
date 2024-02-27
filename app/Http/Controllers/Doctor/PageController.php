<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function dashboard(){
        
        return view('doctor.dashboard');
    }
}
