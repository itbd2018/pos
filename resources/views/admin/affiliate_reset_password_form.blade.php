<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Affiliate - Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
        }

        .card {
            border-radius: 1rem;
            overflow: hidden;
            background: #F69052 !important;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .card-footer {
            background: #f8f9fa;
            border-top: none;
        }

        .logo-circle {
            width: 70px;
            height: 70px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
            box-shadow: 0 2px 8px rgba(246, 144, 82, 0.12);
        }

        .btn-primary {
            background: #fff;
            color: #F69052;
            border: none;
            border-radius: 0.5rem;
            font-weight: bold;
            box-shadow: 0 4px 14px rgba(246, 144, 82, 0.15);
        }

        .btn-primary:hover {
            background: #ffe0cc;
            color: #F69052;
        }

        .text-white {
            color: #fff !important;
        }

      
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-7 col-lg-5">
            <div class="card shadow-lg border-0" style="min-width: 400px; min-height: 500px;">
                <div class="card-header text-white text-center" style="background: transparent; border-bottom: none;">
                    <div class="logo-circle">
                        <i class="fa fa-key fa-2x text-warning"></i>
                    </div>
                    <h4 class="mb-0 font-weight-bold text-white">Affiliate Reset Password</h4>
                </div>
                <div class="card-body p-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle mr-2"></i> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fa fa-exclamation-circle mr-1"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('affiliate.reset.password') }}" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="font-weight-bold text-white">Email Address</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="font-weight-bold text-white">New Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter new password" required>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="font-weight-bold text-white">Confirm
                                Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="Confirm new password" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block py-2">
                            <i class="fa fa-sync-alt"></i> Reset Password
                        </button>

                       
                    </form>

                </div>
                 <div class="card-footer text-center" style="background: transparent; border-top: none; padding: 0;">
                            <a href="{{ route('vendor.login_form') }}" class="btn btn-primary btn-block py-2" style="background: #fff; color: #F69052; font-weight: bold; border: none; box-shadow: 0 4px 14px rgba(246,144,82,0.15); width: 100%; display: block;">
                                <i class="fa fa-arrow-left"></i> Back to Login
                            </a>
                        </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
