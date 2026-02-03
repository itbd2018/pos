@extends('FrontEnd.master')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="row g-0">

                            {{-- show the users data here --}}
                            {{-- Show the user's data here --}}
                            <div class="col-12 p-3 bg-light border-bottom">
                                <h5 class="mb-3 text-primary">Customer Information</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <p class="mb-1"><strong>Name:</strong> {{ $order->name ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <p class="mb-1"><strong>Email:</strong> {{ $order->email ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <p class="mb-1"><strong>Phone:</strong> {{ $order->phone ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <p class="mb-1"><strong>Address:</strong> {{ $order->address ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <p class="mb-1"><strong>Order ID:</strong> #{{ $order->id }}</p>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <p class="mb-1"><strong>Invoice Number:</strong> #{{ $order->invoice_no }}</p>
                                    </div>
                                </div>
                            </div>



                            <!-- Product Image -->
                            <div class="col-md-5 d-flex align-items-center bg-light pe-3">
                                <img src="{{ asset($product->product_thumbnail ?? 'FrontEnd/assect/img/no_laptop_image.jpg') }}"
                                    alt="Product Image" class="img-fluid rounded-start w-100"
                                    style="object-fit: cover; height: 100%;">
                            </div>

                            <!-- Warranty Details -->
                            <div class="col-md-7">
                                <div class="card-body p-4">
                                    <h3 class="card-title mb-3 text-primary">Warranty & Servicing Details</h3>

                                    <h5 class="mb-1"><strong>Product:</strong> {{ $product->name_en ?? 'N/A' }}</h5>
                                    <p class="mb-1"><strong>Serial Number:</strong> {{ $product->serial_number }}</p>
                                    <p class="mb-1"><strong>Delivered Date:</strong>
                                        {{ \Carbon\Carbon::parse($purchaseDate)->format('d M, Y') }}</p>

                                    <hr>

                                    <!-- Warranty Info -->
                                    <h5 class="text-success">Warranty Information</h5>
                                    <p><strong>Warranty Period:</strong> {{ $warrantyDays }} Days</p>
                                    <p><strong>Warranty Expiry:</strong>
                                        {{ \Carbon\Carbon::parse($warrantyExpiry)->format('d M, Y') }}</p>
                                    <p>
                                        <strong>Status:</strong>
                                        @if ($remainingWarrantyDays > 0)
                                            <span class="badge bg-success">Active ({{ $remainingWarrantyDays }} days
                                                left)</span>
                                        @else
                                            <span class="badge bg-danger">Expired</span>
                                        @endif
                                    </p>

                                    <hr>

                                    <!-- Servicing Info -->
                                    <h5 class="text-info">Servicing Information</h5>
                                    <p><strong>Servicing Period:</strong> {{ $servicingYears }} Years</p>
                                    <p><strong>Servicing Expiry:</strong>
                                        {{ \Carbon\Carbon::parse($servicingExpiry)->format('d M, Y') }}</p>
                                    <p>
                                        <strong>Status:</strong>
                                        @if ($remainingServicingDays > 0)
                                            <span class="badge bg-success">Active ({{ $remainingServicingDays }} days
                                                left)</span>
                                        @else
                                            <span class="badge bg-danger">Expired</span>
                                        @endif
                                    </p>

                                    <div class="mt-4">
                                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">🔙 Back</a>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- row -->
                    </div> <!-- card -->

                </div>
            </div>
        </div>
    </section>
@endsection
