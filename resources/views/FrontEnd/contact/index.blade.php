@extends('FrontEnd.master')
@section('title')
    Contact Us
@endsection
@section('content')
    <style>
        body {
            background: #f7f8fa;
        }

        .contact-section {
            padding: 50px 0;
        }

        .contact-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);
            padding: 32px 28px;
            transition: box-shadow 0.3s;
            margin-bottom: 24px;
        }

        .contact-card:hover {
            box-shadow: 0 12px 32px 0 rgba(31, 38, 135, 0.18);
        }

        .contact-card h3 {
            color: #222;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .contact-info-list {
            margin-top: 24px;
        }

        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 18px;
        }

        .contact-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #FF914D 60%, #ffb88c 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 22px;
            margin-right: 16px;
            box-shadow: 0 2px 8px rgba(255, 145, 77, 0.12);
        }

        .contact-info-text {
            color: #444;
            font-size: 16px;
        }

        .contact-form-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);
            padding: 36px 32px;
        }

        .form-label {
            color: #444;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 15px;
            background: #f9f9f9;
            margin-bottom: 16px;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #FF914D;
            background: #fff;
            box-shadow: 0 0 0 2px #ff914d22;
        }

        .btn-send {
            background: linear-gradient(90deg, #FF914D 70%, #ffb88c 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 14px 36px;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.2s;
            box-shadow: 0 2px 8px rgba(255, 145, 77, 0.10);
        }

        .btn-send:hover {
            background: linear-gradient(90deg, #ffb88c 0%, #FF914D 100%);
            color: #fff;
        }

        @media (max-width: 991px) {
            .contact-section {
                padding: 32px 0;
            }

            .contact-form-card,
            .contact-card {
                padding: 24px 12px;
            }
        }
    </style>

    <section class="contact-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="fw-bold" style="color: #222;">Contact Us</h1>
                    <p class="lead" style="color: #666;">We'd love to hear from you! Reach out with your questions, feedback, or just to say hello.</p>
                    <h4 class="text-success mt-3">{{ session('message') }}</h4>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <h3>Get In Touch</h3>
                        <p class="mb-4" style="color: #666;">{{ get_setting('short_description')->value }}</p>
                        <div class="contact-info-list">
                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-info-text">
                                    {{ get_setting('business_address')->value }}
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="fa fa-phone-alt"></i>
                                </div>
                                <div class="contact-info-text">
                                    {{ get_setting('phone')->value }}
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <div class="contact-icon">
                                    <i class="fa fa-envelope-open"></i>
                                </div>
                                <div class="contact-info-text">
                                    {{ get_setting('email')->value }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="contact-form-card">
                        <form action="{{ route('message.submit') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Your Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Your Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Your Email" required>
                                    @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                    <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" id="subject" placeholder="Subject" required>
                                    @error('subject')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" name="message" placeholder="Leave a message here" id="message" rows="5" required></textarea>
                                    @error('message')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-send">
                                        <i class="fa fa-paper-plane me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
