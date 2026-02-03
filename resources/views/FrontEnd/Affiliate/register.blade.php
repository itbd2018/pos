@extends('FrontEnd.master')
@section('content')
    <section class="pb-0 py-2 shadow  bg-white">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="">
                    <a href="{{ route('affiliate') }}">
                        <img style="" src="{{ asset(get_setting('site_logo')->value) }}"
                            class="logo affiliate-logo-width" alt="" />
                    </a>
                </div>
                <div class="d-flex align-items-center" style="gap:20px;">
                    <a href="{{ route('affiliate') }}" class=" px-2 py-1 rounded d-sm-none d-block"
                        style=" font-size: 16px; color: #FF914D; border: 1px solid #FF914D !important;">
                        Affiliate Account
                    </a>
                    <a href="{{ route('vendor.login_form') }}" class=" px-4 py-2 rounded d-sm-block d-none"
                        style=" font-size: 18px; color: #FF914D; border: 1px solid #FF914D !important;">
                        Affiliate Login
                    </a>
                    <a href="" class="px-4 py-2 rounded text-white d-sm-block d-none"
                        style="background-color: #FF914D; font-size: 18px; border: 1px solid #FF914D !important;">
                        Regester
                    </a>

                </div>
            </div>
        </div>
    </section>
    <style>
        .is-invalid {
            border: 1px solid red !important;
        }

        .text-danger {
            color: red !important;
        }
    </style>
    <section style="background-color: #ebebeb;" class="pb-0">
        <div class="container">
            <div class="row mx-0 py-4 d-flex justify-content-center align-items-center ">
                <div class="col col-xl-10 px-0">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0 mx-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block border-end px-0">
                                <img src="{{ asset('FrontEnd/assets/img/affiliate.png') }}" alt="login form"
                                    class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;object-fit: cover; height: 90%; object-position: center;">
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">

                                <div class="card-body px-3 text-black">

                                    @if (session('success'))
                                        <div class="alert alert-success" role="alert"
                                            style="color: green; font-weight: bold;">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('become.a.seller') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="d-none d-md-flex mb-1 align-items-center">
                                            <img src="{{ asset(get_setting('site_logo')->value) }}"
                                                class="logo affiliate-logo-width" alt="" />
                                        </div>

                                        <h3 class="fw-normal mb-4 text-center text-md-left" style="letter-spacing: 1px;">
                                            Create your affiliate account
                                        </h3>

                                        <div class="d-flex align-items-center mb-2 flex-column flex-sm-row"
                                            style="gap: 16px;">
                                            <div class="form-outline w-100">
                                                <label class="form-label" for="shop_owner_name">Full Name</label>
                                                <input style="border-radius: 8px;" type="text" name="shop_owner_name"
                                                    value="{{ old('shop_owner_name') }}"
                                                    class="form-control form-control-sm @error('shop_owner_name') is-invalid @enderror">
                                                @error('shop_owner_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-outline w-100">
                                                <label class="form-label" for="phone">Phone Number</label>
                                                <input style="border-radius: 8px;" type="tel" name="phone"
                                                    value="{{ old('phone') }}"
                                                    class="form-control form-control-sm @error('phone') is-invalid @enderror">
                                                @error('phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="d-flex gap-3 align-items-center mb-2 flex-column flex-sm-row mt-3"
                                            style="gap: 16px;">
                                            <div class="form-outline w-100">
                                                <label class="form-label" for="email">Email</label>
                                                <input style="border-radius: 8px;" type="email" name="email"
                                                    value="{{ old('email') }}"
                                                    class="form-control form-control-sm @error('email') is-invalid @enderror">
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <!--<div class="form-outline w-100">-->
                                            <!--    <label class="form-label" for="address">Address</label>-->
                                            <!--    <input style="border-radius: 8px;" type="text" name="address"-->
                                            <!--        value="{{ old('address') }}"-->
                                            <!--        class="form-control form-control-sm @error('address') is-invalid @enderror">-->
                                            <!--    @error('address')-->
                                            <!--        <small class="text-danger">{{ $message }}</small>-->
                                            <!--    @enderror-->
                                            <!--</div>-->
                                        </div>

                                        <!--<div class="d-flex gap-3 align-items-center mb-2 flex-column flex-sm-row mt-3"-->
                                        <!--    style="gap: 16px;">-->
                                        <!--    <div class="form-outline w-100">-->
                                        <!--        <label class="form-label" for="fb_url">Facebook ID Link</label>-->
                                        <!--        <input style="border-radius: 8px;" type="text" name="fb_url"-->
                                        <!--            value="{{ old('fb_url') }}"-->
                                        <!--            class="form-control form-control-sm @error('fb_url') is-invalid @enderror">-->
                                        <!--        @error('fb_url')-->
                                        <!--            <small class="text-danger">{{ $message }}</small>-->
                                        <!--        @enderror-->
                                        <!--    </div>-->
                                        <!--    <div class="form-outline w-100">-->
                                        <!--        <label class="form-label" for="nid">NID</label>-->
                                        <!--        <input style="border-radius: 8px;" type="file" name="nid"-->
                                        <!--            class="form-control form-control-sm @error('nid') is-invalid @enderror">-->
                                        <!--        @error('nid')-->
                                        <!--            <small class="text-danger">{{ $message }}</small>-->
                                        <!--        @enderror-->
                                        <!--    </div>-->
                                        <!--</div>-->

                                        <div class="d-flex gap-3 align-items-center mb-2 flex-column flex-sm-row mt-3" style="gap: 16px;">
                                            <div class="form-outline w-100 position-relative">
                                                <label class="form-label" for="password">Password</label>
                                                <input style="border-radius: 8px;" type="password" name="password" id="password"
                                                    class="form-control form-control-sm @error('password') is-invalid @enderror">
                                                <!-- Eye icon button positioned correctly -->
                                                <button type="button" class="btn btn-link position-absolute top-50 end-0 translate-middle-y" id="toggle-password" style="right: 0px;border: none;background: transparent;bottom: 0px;">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-outline w-100">
                                                <label class="form-label" for="password_confirmation">ReType Password</label>
                                                <input style="border-radius: 8px;" type="password" name="password_confirmation" class="form-control form-control-sm">
                                            </div>
                                        </div>

                                        <div class="pt-1 mb-3 mt-3 w-100">
                                            <label class="form-label" for="shop_profile">Referral ID</label>
                                            <input style="border-radius: 8px;" type="text" name="affiliate_id" required
                                                class="form-control form-control-sm @error('shop_profile') is-invalid @enderror">
                                            @error('affiliate_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="pt-1 mb-3 mt-3 w-100">
                                            <label class="form-label" for="shop_profile">Profile Image</label>
                                            <input style="border-radius: 8px;" type="file" name="shop_profile"
                                                class="form-control form-control-sm @error('shop_profile') is-invalid @enderror">
                                            @error('shop_profile')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="pt-1 mb-3 mt-3">
                                            <button
                                                style="background-color: #FF914D !important; border: none; width: 100%; padding: 6px 16px; border-radius:8px; color: white !important; font-weight: 500; font-size: 16px;"
                                                class="btn btn-dark btn-lg btn-block" type="submit">
                                                Signup
                                            </button>
                                        </div>

                                        <div
                                            class="d-flex align-items-center justify-content-between flex-column flex-sm-row">
                                            <p class="mt-2" style="color: #393f81;">Already have an account?
                                                <a href="{{ route('vendor.login_form') }}" style="color: #EF8848 !important;!i;!;font-weight: 700;">Log in</a>
                                            </p>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')

<script>
    document.getElementById('toggle-password').addEventListener('click', function () {
        var passwordField = document.getElementById('password');
        var passwordFieldType = passwordField.type;
        if (passwordFieldType === 'password') {
            passwordField.type = 'text';
            this.innerHTML = '<i class="fas fa-eye-slash"></i>';  // Change icon to eye-slash
        } else {
            passwordField.type = 'password';
            this.innerHTML = '<i class="fas fa-eye"></i>';  // Change icon back to eye
        }
    });
</script>
@endpush
