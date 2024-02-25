<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('assets/images/favicon.png') }}>
    <title>LAB SYSTEM</title>

    <link href="{{ asset('dist/css/pages/login-register-lock.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
</head>

<body>
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url({{ asset('assets/images/background/login-register.jpg') }});">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material text-center" id="loginform">
                    <a class="db"><h3><b>LAB SYSTEM</b></h3></a>

                    <p class="text-center">I am a</p>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <a href="{{ route('patient.login') }}" class="btn btn-info btn-lg w-100 text-uppercase btn-rounded text-white" type="submit">Patient</a>
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <a href="{{ route('doctor.login') }}" class="btn btn-info btn-lg w-100 text-uppercase btn-rounded text-white" type="submit">Doctor</a>
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <a href="{{ route('administrator.login') }}" class="btn btn-info btn-lg w-100 text-uppercase btn-rounded text-white" type="submit">Administrator</a>
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
