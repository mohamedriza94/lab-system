<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>LAB SYSTEM</title>
    <link href="{{ asset('dist/css/pages/login-register-lock.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
</head>
<body>
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url({{ asset('assets/images/background/login-register.jpg') }});">
        <div class="login-box card">
            <div class="card-body">
                <!-- Display the appropriate form based on verification status -->
                @if(session('verified'))
                <!-- User is verified, show OTP and password reset form -->
                <form class="form-horizontal form-material text-left" action="{{ url('patient/passwordChange/otp') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}"> <!-- Presuming email is stored in session -->
                    <h3 class="box-title m-b-20">Enter OTP and New Password</h3>

                    <div class="form-group">
                        <input class="form-control" type="text" name="token" required placeholder="OTP">
                    </div>
                    <input class="form-control" type="text" name="email" required placeholder="Email" value="{{ isset($email) ? $email : '' }}">

                    <div class="form-group">
                        <input class="form-control" type="password" name="password" required placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password_confirmation" required placeholder="Confirm New Password">
                    </div>
                    <div class="form-group text-center m-t-20">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset Password</button>
                    </div>
                </form>
                @else
                <!-- User needs to verify email first -->
                <form class="form-horizontal form-material text-left" action="{{ url('patient/passwordChange') }}" method="POST">
                    @csrf
                    <h3 class="box-title m-b-20">Patient Password Reset</h3>
                    <!-- Error and Success Alerts -->
                    @if(session('failure'))
                        <div class="alert alert-danger">{{ session('failure') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="form-group">
                        <input class="form-control" type="text" name="email" required placeholder="Email">
                    </div>
                    <div class="form-group text-center m-t-20">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Send OTP</button>
                    </div>
                </form>
                @endif
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        Remember your password? <a href="{{ route('patient.login') }}" class="text-primary m-l-5"><b>Login</b></a>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                        <a href="{{ url('/') }}" class="text-primary m-l-5"><b>Go Back</b></a>
                    </div>
                </div>
            </div>
        </div>

