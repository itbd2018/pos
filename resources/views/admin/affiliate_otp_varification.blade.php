
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Affiliate - OTP Verification</title>
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
            box-shadow: 0 2px 8px rgba(38, 143, 255, 0.12);
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
        <div class="card shadow-lg border-0">
            <div class="card-header text-white text-center" style="background: transparent; border-bottom: none;">
                <div class="logo-circle">
                    <i class="fa fa-key fa-2x text-warning"></i>
                </div>
                <h4 class="mb-0 font-weight-bold text-white">Affiliate OTP Verification</h4>
            </div>
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session('error'))
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

                <p class="text-white text-center mb-4">
                    Please enter the 4-digit OTP sent to your email.
                </p>

                <form method="POST" action="{{ route('affiliate.otp.verify') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="otp" class="font-weight-bold text-white">OTP Code</label>
                        <input type="text" name="otp" id="otp" maxlength="6"
                               class="form-control @error('otp') is-invalid @enderror"
                               placeholder="Enter OTP" required autofocus>
                        @error('otp')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block py-2">
                        <i class="fa fa-check-circle"></i> Verify OTP
                    </button>
                </form>

                <div class="mt-3 text-center">
                    <a href="{{ route('afiliate.password.request') }}" method="GET" class="text-white font-weight-bold">Resend OTP</a>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
