
@extends('FrontEnd.master')
@section('title')
    Shipping & Return
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid py-5 page-header">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2 class="display-3 fw-bold" style="color: black;">{{ get_setting('site_name')->value }}</h2>
                    <div class="d-flex justify-content-center mt-3">
                        <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">Shipping & Return</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-11 mb-40 mx-auto pb-4">
                <div class="card py-4 px-3 shadow-sm" style="background-color: #FFECCA !important">
                    <p class="">
                        @if (session()->get('language') == 'bangla')
                            {!! nl2br($page->shipping_return) !!}
                        @else
                            {!! nl2br($page->shipping_return) !!}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
@endsection
