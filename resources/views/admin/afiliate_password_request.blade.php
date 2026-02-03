
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Affiliate - Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-7 col-lg-5">
        <div class="card shadow-lg border-0" style="min-width: 400px; min-height: 500px;">
            <div class="card-header text-white text-center">
                <div class="logo-circle">
                    <i class="fa fa-unlock-alt fa-2x text-primary"></i>
                </div>
                <h4 class="mb-0 font-weight-bold">Affiliate Password Reset</h4>
            </div>
            <div class="card-body p-4">
                <p class="text-white text-center mb-4">
                    Enter your registered email address and we'll send you a password reset Otp.
                </p>

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Error Message --}}
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

                <form method="POST" action="{{ route('affiliate.password.email') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="font-weight-bold">Email Address</label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" id="sendOtpBtn" class="btn btn-primary btn-block py-2 btn-white">
                        <i class="fa fa-paper-plane"></i> Send OTP
                    </button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('vendor.login_form') }}" class="text-primary font-weight-bold">
                    <i class="fa fa-arrow-left"></i> Back to Login
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Add custom style for white button
    const style = document.createElement('style');
    style.innerHTML = `.btn-white { background: #fff !important; color: #F69052 !important; border: none; } .btn-white:active, .btn-white.active { background: #2575fc !important; color: #fff !important; }`;
    document.head.appendChild(style);

    // Change button color on click
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('sendOtpBtn');
        if (btn) {
            btn.addEventListener('click', function() {
                btn.classList.remove('btn-white');
                btn.classList.add('active');
            });
        }
    });
</script>
</body>
</html>
