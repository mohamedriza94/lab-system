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
                <form class="form-horizontal form-material text-left" id="loginform" action="{{ route('patient.register.submit') }}" method="POST">
                    @csrf
                    <a class="db"><h3><b>PATIENT REGISTRATION</b></h3></a>

                    <!-- Error Alert -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Success Alert -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="email" required="" placeholder="Email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="name" required="" placeholder="Name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="nic" required="" placeholder="NIC Number" value="{{ old('nic') }}">
                        </div>
                    </div>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <label class="text-left">Date of Birth</label>
                            <input class="form-control" type="date" name="dateOfBirth" required="" placeholder="Date of Birth" value="{{ old('dateOfBirth') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg w-100 text-uppercase btn-rounded text-white" type="submit">Register</button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            Already have an account? <a href="{{ route('patient.login') }}" class="text-primary m-l-5"><b>Login</b></a>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <a href="{{ url('/') }}" class="text-primary m-l-5"><b>GO BACK</b></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
