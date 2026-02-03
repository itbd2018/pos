@extends('FrontEnd.master')

@section('content')
<style>
    .hero {
        background: linear-gradient(135deg, #000000 0%, #2c2c2c 100%);
        color: white;
        padding: 80px 20px !important;
        position: relative;
        overflow: hidden;
    }

    .container {
        max-width: 1280px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .hero-content {
        flex: 1;
        min-width: 300px;
        padding-right: 40px;
        z-index: 2;
    }

    .hero-image {
        flex: 1;
        min-width: 300px;
        text-align: center;
        z-index: 2;
    }

    .hero-image img {
        max-width: 100%;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    h1 {
        font-size: 3rem;
        margin-bottom: 20px;
        color: #FF914D;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    h2 {
        font-size: 1.8rem;
        margin-bottom: 25px;
        color: #FF914D;
        font-weight: 600;
    }

    p {
        font-size: 1.1rem;
        margin-bottom: 30px;
        max-width: 600px;
    }

    .warranty-badges {
        display: flex;
        gap: 20px;
        margin-top: 30px;
    }

    .badge {
        background-color: #FF914D;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        font-weight: bold;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .badge span {
        display: block;
        font-size: 0.9rem;
        font-weight: normal;
        margin-top: 5px;
    }

    .badge:hover {
        background-color: #ff7e2e;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
        transition: all 0.3s ease;
        text-decoration: none;
        color: white;
    }

    .decoration {
        position: absolute;
        width: 300px;
        height: 300px;
        background-color: #FF914D;
        opacity: 0.1;
        border-radius: 50%;
        z-index: 1;
    }

    .decoration-1 {
        top: -150px;
        right: -100px;
    }

    .decoration-2 {
        bottom: -150px;
        left: -100px;
    }

    @media (max-width: 768px) {
        .container {
            /* flex-direction: column; */
        }

        .hero-content {
            padding-right: 0;
            margin-bottom: 40px;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
        }

        .warranty-badges {
            justify-content: center;
        }
    }
</style>
<section class="hero">
    <div class="decoration decoration-1"></div>
    <div class="decoration decoration-2"></div>
    <div class="container">
        <div class="hero-content">
            <h1>Laptop Ache Warranty Policy</h1>
            <h2>Our Commitment to You</h2>
            <p>
                Thank you for choosing Laptop Ache. We stand behind the quality of our products and are
                committed to providing you with excellent post-purchase support. Our warranty policy is
                designed to give you complete peace of mind, ensuring you can shop with confidence.
                This policy is divided into two parts: a 40-Day Replacement Warranty and a 3-Year Free
                Service Warranty.
            </p>
            <div class="warranty-badges">
                <a href="#warranty-check" class="badge ">
                    Check Warranty
                    <span>Verify your product</span>
                </a>
                <a href="{{ route('page.contact') }}" class="badge">
                    Contact Us
                    <span>Get support</span>
                </a>
            </div>
        </div>
        <div class="hero-image">
            <img src="{{ asset('FrontEnd/assets/img/warrenty.jpg') }}" alt="Laptop Ache Warranty">
        </div>
    </div>
</section>
<style>
    .warranty-section {
        max-width: 1280px;
        margin: 40px auto;
        padding: 40px !important;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        font-family: 'Arial', sans-serif;
        color: #000000;
    }

    .section-heading {
        font-size: 28px;
        color: #FF914D;
        text-align: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
    }

    .intro-text {
        font-size: 16px;
        line-height: 1.6;
        text-align: center;
        margin: auto;
        margin-bottom: 40px;
        color: #333333;
    }

    .coverage-container {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        justify-content: space-between;
    }

    .coverage-details,
    .exclusions {
        flex: 1 1 45%;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #FF914D;
        transition: transform 0.3s ease;
    }



    .section-subheading {
        font-size: 20px;
        color: #FF914D;
        margin-bottom: 15px;
        position: relative;
    }

    .section-subheading::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 50px;
        height: 2px;
        background-color: #FF914D;
    }

    .coverage-list,
    .exclusions-list {
        list-style-type: disc;
        /* Dotted (disc) style for li */
        padding-left: 20px;
        margin: 0;
    }

    .coverage-item,
    .exclusion-item {
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 10px;
        color: #000000;
    }

    .exclusion-intro {
        font-size: 15px;
        margin-bottom: 15px;
        color: #333333;
    }

    @media (max-width: 768px) {
        .coverage-container {
            flex-direction: column;
            gap: 30px;
        }
    }
</style>

<section id="warranty-check" class="warranty-section p-0 my-5">
    <div class="check-form-container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="warranty-card">
                    <div class="row g-0">
                        <!-- Left Side Image -->
                        <div class="col-lg-6 warranty-image-col">
                            <div class="warranty-image-wrapper">
                                <img src="{{ asset('FrontEnd/assets/img/warrenty-checkpng.png') }}" alt="Warranty Check"
                                    class="warranty-image" />
                                <div class="image-overlay"></div>
                            </div>
                        </div>

                        <!-- Warranty Form Section -->
                        <div class="col-lg-6 warranty-form-col">
                            <div class="warranty-form-wrapper">
                                <div class="warranty-form-header">
                                    <h4 class="brand-name">Laptopache.com</h4>
                                    @if(session()->has('message'))
                                    <div class="alert alert-info alert-dismissible fade show" id="error_msg">
                                        {{ session()->get('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                    @endif
                                    <h2 class="form-title">Check Your Warranty</h2>
                                    <p class="form-subtitle">Enter your product <strong>Serial Number</strong> below to
                                        view warranty details</p>
                                </div>

                                <form method="get" action="{{ route('warranty.check') }}"
                                    class="warranty-check-form needs-validation" novalidate>
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <label for="serialNumber">Product Serial Number</label>
                                        <input type="text" name="serial_number"
                                            class="form-control @error('serial_number') is-invalid @enderror"
                                            id="serialNumber" placeholder="Enter Serial Number"
                                            value="{{ old('serial_number') }}" required />
                                        @error('serial_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-check-warranty w-100">
                                        Check Warranty Status
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="warranty-section">
    <h2 class="section-heading">40-Day Replacement Warranty</h2>
    <p class="intro-text">
        Shop with confidence. For the first 40 days from the date of purchase, your product is
        covered by our full replacement warranty. <strong> We are here for you</strong> if any issue arises.

    </p>

    <div class="coverage-container">
        <div class="coverage-details">
            <h3 class="section-subheading">Coverage Details:</h3>
            <ul class="coverage-list">
                <li class="coverage-item"><strong>Eligibility:</strong> This warranty covers any manufacturing defects
                    in materials or
                    workmanship that result in product failure under normal use.
                </li>
                <li class="coverage-item"><strong>Duration:</strong> 40 calendar days from the date of your original
                    purchase.</li>
                <li class="coverage-item"><strong>Resolution:</strong> If your product is found to be defective within
                    this period, we will provide you with a brand-new, sealed replacement unit of the same model,
                    completely free of charge.</li>
                <li class="coverage-item"><strong>Process:</strong> Simply contact our support team with your proof of
                    purchase and a description of the issue. We will guide you through the verification and replacement
                    process.</li>
            </ul>
        </div>

        <div class="exclusions">
            <h3 class="section-subheading">Exclusions from the 40-Day Replacement Warranty:</h3>
            <p class="exclusion-intro">This replacement warranty does not cover issues arising from:</p>
            <ul class="exclusions-list">
                <li class="exclusion-item">Accidental damage such as drops, spills, or liquid damage.</li>
                <li class="exclusion-item">Misuse, neglect, or improper handling of the product.</li>
                <li class="exclusion-item">Software-related issues that can be resolved through a system reset or
                    software update.</li>
                <li class="exclusion-item">Any unauthorized repairs, modifications, or tampering.</li>
                <li class="exclusion-item">Cosmetic damage (e.g., scratches, dents) that does not affect the product's
                    functionality.</li>
            </ul>
        </div>
    </div>
</section>
<style>
    .warranty-section {
        max-width: 1280px;
        margin: 40px auto;
        padding: 40px !important;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        font-family: 'Arial', sans-serif;
        color: #000000;
    }

    .section-heading {
        font-size: 28px;
        color: #FF914D;
        text-align: center;
    }

    .intro-text {
        font-size: 16px;
        line-height: 1.6;
        text-align: center;
        color: #333333;
    }

    .coverage-container {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        justify-content: space-between;
    }

    .coverage-details,
    .exclusions {
        flex: 1 1 45%;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #FF914D;
        transition: transform 0.3s ease;
    }



    .section-subheading {
        font-size: 20px;
        color: #FF914D;
        margin-bottom: 15px;
        position: relative;
    }

    .section-subheading::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 50px;
        height: 2px;
        background-color: #FF914D;
    }

    .coverage-list,
    .exclusions-list {
        list-style-type: disc;
        /* Dotted (disc) style for li */
        padding-left: 20px;
        margin: 0;
    }

    .coverage-item,
    .exclusion-item {
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 10px;
        color: #000000;
    }

    .exclusion-intro {
        font-size: 15px;
        margin-bottom: 15px;
        color: #333333;
    }

    @media (max-width: 768px) {
        .coverage-container {
            flex-direction: column;
            gap: 30px;
        }
    }
</style>

<section class="warranty-section">
    <h2 class="section-heading">3-Year Free Service Warranty (Without Parts)</h2>
    <p class="intro-text text-center m-auto ">
        We value your long-term satisfaction. After your 40-day replacement period ends, your
        product is protected by our 3-Year Free Service Warranty.
    </p>

    <div class="coverage-container mt-4">
        <div class="coverage-details">
            <h3 class="section-subheading ">Coverage Details:</h3>
            <ul class="coverage-list">
                <li class="coverage-item"><strong>Eligibility:</strong> This warranty covers the labor costs associated
                    with diagnosing and
                    repairing any software or hardware issues.</li>
                <li class="coverage-item"><strong>Duration:</strong> 3 full years (1095 days) from your original date of
                    purchase.</li>
                <li class="coverage-item"><strong>What "Free Service" Means:</strong> Our expert technicians will
                    diagnose, troubleshoot,
                    and perform all necessary repairs on your device without charging you any labor
                    or service fees. This includes tasks like software re-installation, system
                    diagnostics, and hardware component repairs.</li>
                <li class="coverage-item"><strong>"Without Parts" Clarification:</strong> Please note that this service
                    warranty does not
                    cover the cost of any physical parts that may need to be replaced. If a repair
                    requires a new component (e.g., a new screen, battery, or motherboard), you will
                    only be charged for the cost of that specific part. The labor to install it remains
                    free.</li>
            </ul>
            <p class="example-scenario">Example Scenario: If your device's charging port stops working after 18 months,
                you can
                bring it to us. Our technicians will diagnose the problem and perform the repair for free.
                You would only pay the price of the new charging port component itself.</p>
        </div>
    </div>
</section>

<style>
    .claim-section,
    .terms-section {
        max-width: 1280px;
        margin: 40px auto;
        padding: 40px !important;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 2px solid #FF914D;
    }

    .claim-heading,
    .terms-heading {
        font-size: 2.5rem;
        font-weight: 700;
        color: #FF914D;
        text-align: center;
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 15px;
    }

    .claim-heading::after,
    .terms-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, #FF914D 0%, #ffb380 100%);
        border-radius: 2px;
    }

    .steps-intro {
        font-size: 1.2rem;
        line-height: 1.8;
        text-align: center;
        margin: auto;
        margin-bottom: 40px;
        color: #555;
    }

    .steps-list,
    .terms-list {
        list-style: none;
        padding: 0;
        counter-reset: item;
    }

    .step-item,
    .term-item {
        position: relative;
        padding: 20px 30px;
        margin-bottom: 15px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .step-item:hover,
    .term-item:hover {
        transform: translateY(-5px);
    }

    .step-item::before {
        counter-increment: item;
        content: counter(item);
        position: absolute;
        left: -15px;
        top: 50%;
        transform: translateY(-50%);
        background: #FF914D;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .term-item::before {
        content: '•';
        color: #FF914D;
        font-size: 2rem;
        position: absolute;
        left: 10px;
    }

    .closing-text {
        font-size: 1.2rem;
        line-height: 1.8;
        text-align: center;
        width: 100%;
        color: #555;
        margin-top: 40px;
        padding: 20px;
        background: rgba(255, 145, 77, 0.1);
        border-radius: 10px;
    }

    /* Warranty Check Form Styling */
    .warranty-check-section {
        background: linear-gradient(135deg, #FF914D 0%, #ff7e2e 100%);
        border-radius: 20px;
        overflow: hidden;
        margin: 40px auto;
        box-shadow: 0 15px 30px rgba(255, 145, 77, 0.2);
    }

    .warranty-form-container {
        padding: 40px;
    }

    .warranty-form-heading {
        color: white;
        font-size: 2rem;
        margin-bottom: 30px;
        text-align: center;
    }

    .warranty-form input {
        border: none;
        border-radius: 8px;
        padding: 15px;
        font-size: 1.1rem;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.3s ease;
    }



    .warranty-check-btn {
        background: #2b2b2b !important;
        color: white;
        padding: 15px 30px;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }



    @media (max-width: 768px) {

        .claim-heading,
        .terms-heading {
            font-size: 2rem;
        }

        .warranty-form-container {
            padding: 20px;
        }
    }
</style>
<section>
    <section class="claim-section">
        <h2 class="claim-heading">How to Make a Warranty Claim</h2>
        <p class="steps-intro">Should you encounter any issues with your product, please follow these simple steps:</p>
        <ol class="steps-list">
            <li class="step-item">
                <strong>
                    Contact Support:
                </strong>
                Reach out to our Customer Support team via email at
                info@laptopache.com or call us at <a class="underline" href="tel:+8801901378164"> ">
                    +8801901378164
                </a>
                <a href="tel:+8801780966740" class="underline">
                    +8801780966740
                </a>
            </li>
            <li class="step-item">
                <strong>
                    Provide Details:
                </strong>
                Please have your original purchase receipt or order number
                ready. Describe the issue you are facing in as much detail as possible. Our team
                may guide you through some initial troubleshooting steps.
            </li>
            <li class="step-item"><strong>
                    Service/Replacement Authorization:
                </strong>If the issue cannot be resolved remotely,
                our team will provide you with instructions on how to send or bring the product to
                our authorized service center for inspection and resolution.
            </li>
        </ol>
    </section>

    <section class="terms-section">
        <h2 class="terms-heading">General Terms & Conditions</h2>
        <ul class="terms-list">
            <li class="term-item">This warranty is valid only for the original purchaser and is non-transferable.</li>
            <li class="term-item">Proof of purchase is required for all warranty claims.
            </li>
            <li class="term-item">Laptop Ache reserves the right to determine the eligibility of any product for
                warranty coverage. </li>
            <li class="term-item">This warranty does not cover damage caused by external factors such as power
                surges, natural disasters, or use with incompatible accessories. </li>
        </ul>
        <p class="closing-text m-auto w-100">We are dedicated to ensuring your product serves you well. If you have any
            questions
            about our warranty policy, please do not hesitate to contact us.</p>
    </section>
</section>
<style>
    .check-form-container {
        /* max-width: 1280px;
            padding: 60px 20px; */
        margin: 0 auto;
    }

    .warranty-check-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .warranty-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .warranty-image-col {
        position: relative;
    }

    .warranty-image-wrapper {
        position: relative;
        height: 100%;
        min-height: 400px;
    }

    .warranty-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;

    }

    .warranty-form-col {
        background: #fff;
    }

    .warranty-form-wrapper {
        padding: 40px;
    }

    .warranty-form-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .brand-name {
        color: #FF914D;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .form-title {
        font-size: 28px;
        color: #2c2c2c;
        margin-bottom: 10px;
    }

    .form-subtitle {
        color: #6c757d;
        font-size: 16px;
    }

    .warranty-check-form .form-control {
        padding: 12px 20px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .warranty-check-form .form-control:focus {
        border-color: #FF914D;
        box-shadow: 0 0 0 0.2rem rgba(255, 145, 77, 0.25);
    }

    .btn-check-warranty {
        background: #FF914D;
        color: #fff;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-check-warranty:hover {
        background: #ff7e2e;
        transform: translateY(-2px);
    }

    @media (max-width: 991px) {
        .warranty-image-wrapper {
            min-height: 300px;
        }

        .warranty-form-wrapper {
            padding: 30px;
        }
    }

    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
</style>


@endsection
@push('js')
<script>
    $(document).ready(function() {
        // Auto hide alert after 3 seconds
        setTimeout(function() {
            $("#error_msg").fadeOut('slow');
        }, 3000);

        // Initialize floating labels
        $('.form-floating input').on('focus blur', function(e) {
            $(this).parents('.form-floating').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
        }).trigger('blur');
    });
</script>
@endpush