<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    @vite(['resources/css/sb-admin-2.css'])
    @vite(['resources/js/sb-admin-2.js'])

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user"
                                                    id="first_name" placeholder="First Name" name="first_name" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user"
                                                    id="last_name" placeholder="Last Name" name="last_name" required>
                                            </div>
                                        </div>
                                         {{-- <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="email" class="form-control form-control-user"
                                                    id="email" placeholder="Email Address" name="email" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="number" class="form-control form-control-user"
                                                    id="phone_number" placeholder="Contact Number"
                                                    name="phone_number" required>
                                            </div>
                                        </div> --}}
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email"
                                                placeholder="Email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="phone_number"
                                                placeholder="Contact Number" maxlength="10" name="phone_number" required>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user"
                                                    id="password" placeholder="Password" name="password" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user"
                                                    id="password_confirmation" placeholder="Repeat Password"
                                                    name="password_confirmation" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Register Account
                                        </button>
                                        <hr>
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> -->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">Forgot Password</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">Already have an account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</body>

</html>
