{{-- <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        @php $route = Route::current()->getName(); @endphp
        <title>{{$route == 'login_form' ? 'Admin':'Vendor'}} Login</title>
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta property="og:title" content="" />
<meta property="og:type" content="" />
<meta property="og:url" content="" />
<meta property="og:image" content="" />
<!-- Favicon -->
@php
$logo = get_setting('site_favicon');
@endphp
@if ($logo != null)
<link rel="shortcut icon" type="image/x-icon" href="{{ asset(get_setting('site_favicon')->value ?? ' ') }}" />
@else
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}" />
@endif
<!-- Template CSS -->
<link href="{{ asset('backend/assets/{{asset('backend')}}/login-form/css/main.css?v=1.1 ' ) }}" rel="stylesheet" type="text/css" />
<!-- toastr css -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <main>
        <section class="content-main">
            <div class="card mx-auto card-login shadow-lg" style="margin-top: 140px;">
                <div class="card-body">

                    <!-- start login aleart message show -->
                    @if (Session::has('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session::get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <!-- end login aleart message show -->

                    <h4 class="card-title mb-4 text-center">{{$route == 'login_form' ? 'Admin':'Vendor'}} Login</h4>
                    <form action="{{ route('admin.login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <input class="form-control" placeholder="Username or email" type="text" id="email" name="email" value="{{old('email')}}" />
                            @error('email')
                            <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- form-group// -->
                        <div class="mb-3">
                            <input class="form-control" placeholder="Password" id="password" type="password" name="password" />
                            @error('password')
                            <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" checked="" />
                                <span class="form-check-label">Remember</span>
                            </label>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100 justify-content-center">Login</button>
                        </div>
                        <!-- form-group// -->
                    </form>
                    <style type="text/css">
                        table,
                        tbody,
                        tfoot,
                        thead,
                        tr,
                        th,
                        td {
                            border: 1px solid #dee2e6 !important;
                        }

                        th {
                            font-weight: bolder !important;
                        }

                        .custom_input input,
                        button,
                        select,
                        optgroup,
                        textarea {
                            margin: 0;
                            font-family: inherit;
                            font-size: inherit;
                            line-height: inherit;
                            border: none;
                            width: 72px;
                        }
                    </style>
                    <div class="mt-4 {{$route == 'vendor.login_form' ? 'd-none':''}} d-none">
                        <table class="table table-bordered custom_input">
                            <tbody>
                                <tr>
                                    <td>admin@gmail.com</td>
                                    <td><input type="password" name="" value="12345678" disabled></td>
                                    <td><button class="btn btn-info btn-xs" onclick="autoFill()">Copy</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset('backend/assets/js/vendors/jquery-3.6.0.min.js ') }}"></script>
    <script src="{{ asset('backend/assets/js/vendors/bootstrap.bundle.min.js ') }}"></script>
    <script src="{{ asset('backend/assets/js/vendors/jquery.fullscreen.min.js ') }}"></script>
    <!-- Main Script -->
    <script src="{{ asset('backend/assets/js/main.js?v=1.1" type="text/javascript ') }}"></script>

    <!-- toastr js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- all toastr message show -->
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
        @endif
    </script>

    <!-- 3 color toastr message show -->
    <script type="text/javascript">
        @if(Session::has('success'))
        toastr.success("{{Session::get('success') }}");
        @endif
        @if(Session::has('warning'))
        toastr.warning("{{Session::get('warning') }}");
        @endif
        @if(Session::has('info'))
        toastr.info("{{Session::get('info') }}");
        @endif
    </script>

    <!-- copy to password show  -->
    <script type="text/javascript">
        function autoFill() {
            $('#email').val('admin@gmail.com');
            $('#password').val('12345678');
        }
    </script>
</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <title>ITBD</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset(get_setting('site_favicon')->value) }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/login-form/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend') }}/login-form/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend') }}/login-form/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/login-form/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend') }}/login-form/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend') }}/login-form/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/login-form/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend') }}/login-form/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/login-form/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/login-form/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100"
            style="background-image: url('{{ asset('backend') }}/login-form/images/bg-01.jpg');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="{{ route('admin.login') }}" method="post">
                    @csrf
                    <span class="login100-form-logo">
                        <img src="{{ asset(get_setting('site_favicon')->value) }}" style="height:90px; width:90px;"
                            alt="">
                    </span>

                    <span class="login100-form-title p-b-34 p-t-27">
                        Log in
                    </span>
                    @if (session('message'))
                    <div class="alert alert-{{ session('alert-type') }}">
                        @if (session('alert-type') == 'error')
                        <i class="fa fa-exclamation-circle"></i>
                        @endif
                        <strong>{{ session('message') }}</strong>
                    </div>
                    @endif
                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <input class="input100" type="text" placeholder="Email" name="email"
                            value="{{ old('email') }}">

                        @error('email')
                        <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                        @enderror
                        <span class="focus-input100" data-placeholder="&#xf207;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        @error('password')
                        <span class="text-danger" style="font-weight: bold;">{{ $message }}</span>
                        @enderror
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>
                    {{-- Forgot Password Link --}}
                    {{-- <div class="text-right p-t-8 p-b-20">
                        <a href="{{ route('afiliate.password.request') }}" class="txt1"
                    style="font-weight: bold; color: #ebeff2;">
                    <i class="fa fa-unlock-alt"></i> Forgot Password?
                    </a>
            </div> --}}

            <div class="container-login100-form-btn">
                <button class="login100-form-btn">
                    Login
                </button>
            </div>


            </form>
        </div>
    </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('backend') }}/login-form/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('backend') }}/login-form/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('backend') }}/login-form/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ asset('backend') }}/login-form/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('backend') }}/login-form/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('backend') }}/login-form/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('backend') }}/login-form/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('backend') }}/login-form/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('backend') }}/login-form/js/main.js"></script>

</body>

</html>