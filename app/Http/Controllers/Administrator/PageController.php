<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function dashboard(){
        return view('administrator.dashboard');
    }
}
