<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::PATIENT;

    public function __construct()
    {
        $this->middleware('guest:patient')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('patient');
    }

    public function showLoginForm()
    {
        return view('patient.login');
    }

    public function validateLogin(Request $request)
    {
        // Attempt to log the user in
        if ($this->guard()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('patient.dashboard'));
        }

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'password' => 'Invalid Email or Password!'
        ]);
    }

    protected function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/patient/dashboard';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        Session::flush();
        $request->session()->regenerate(true);
        return redirect()->route('patient.login');
    }
}