@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="content-header">
        <h2 class="content-title">Page Content Add</h2>
        <div class="">
            {{-- <a href="{{ route('page.index') }}" title="Page List" class="btn btn-primary"><i class="fa fa-list"></i> </a> --}}
        </div>
    </div>
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
                        {{-- @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif --}}
		                <div class="col-md-12">
		                    <form method="POST" action="{{ route('page.update', $page->id) }}" enctype="multipart/form-data">
		                    	@csrf
		                        {{-- <div class="mb-4">
		                           <label for="name_en" class="col-form-label" style="font-weight: bold;"> Name*:</label>
		                            <input class="form-control" id="name_en" type="text" name="name_en" placeholder="Write page name english" value="{{old('name_en')}}">
		                            @error('name_en')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div> --}}

		                        {{-- <div class="mb-4">
		                          <label for="name_bn" class="col-form-label" style="font-weight: bold;"> Name (Bangla):</label>
		                            <input class="form-control" id="name_bn" type="text" name="name_bn" placeholder="Write page name bangla" value="{{old('name_bn')}}">
		                        </div>
		                        <div class="mb-4">
		                          <label for="title" class="col-form-label" style="font-weight: bold;"> Title:</label>
		                            <input class="form-control" id="title" type="text" name="title" placeholder="Write page title" value="{{old('title')}}">
		                        </div> --}}
                                <h2> FAQs</h2>
		                        <div class="mb-4">
		                          <label for="description_en" class="col-form-label" style="font-weight: bold;">Description:</label>
		                            <textarea name="faq" cols="5" placeholder="Write page description english" class="form-control summernote">{{ $page->faq }}</textarea>
		                            @error('description_en')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>
		                        <div class="mb-4 d-none">
		                          	<label for="description_bn" class="col-form-label" style="font-weight: bold;">Description (Bangla):</label>
		                            <textarea name="faq_bn" id="description_bn" cols="5" placeholder="Write page description bangla" class="form-control summernote">{{ $page->faq_bn }}</textarea>
		                        </div>
                                <h2> About </h2>
		                        <div class="mb-4">
		                          <label for="description_en" class="col-form-label" style="font-weight: bold;">Description:</label>
		                            <textarea name="about" id="description_en" cols="5" placeholder="Write page description english" class="form-control summernote">{{ $page->about }}</textarea>
		                            @error('description_en')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>
		                        <div class="mb-4 d-none">
		                          	<label for="description_bn" class="col-form-label" style="font-weight: bold;">Description (Bangla):</label>
		                            <textarea name="about_bn" id="description_bn" cols="5" placeholder="Write page description bangla" class="form-control summernote">{{ $page->about_bn }}</textarea>
		                        </div>
                                <h2> Privacy-Policy </h2>
		                        <div class="mb-4">
		                          <label for="description_en" class="col-form-label" style="font-weight: bold;">Description:</label>
		                            <textarea name="privacy" id="description_en" cols="5" placeholder="Write page description english" class="form-control summernote">{{ $page->privacy }}</textarea>
		                            @error('description_en')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>
		                        <div class="mb-4 d-none">
		                          	<label for="description_bn" class="col-form-label" style="font-weight: bold;">Description (Bangla):</label>
		                            <textarea name="privacy_bn" id="description_bn" cols="5" placeholder="Write page description bangla" class="form-control summernote">{{ $page->privacy_bn }}</textarea>
		                        </div>

                                <h2> Terms & Condition </h2>
		                        <div class="mb-4">
		                          <label for="description_en" class="col-form-label" style="font-weight: bold;">Description:</label>
		                            <textarea name="terms" id="description_en" cols="5" placeholder="Write page description english" class="form-control summernote">{{ $page->terms }}</textarea>
		                            @error('description_en')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>
		                        <div class="mb-4 d-none">
		                          	<label for="description_bn" class="col-form-label" style="font-weight: bold;">Description (Bangla):</label>
		                            <textarea name="terms_bn" id="description_bn" cols="5" placeholder="Write page description bangla" class="form-control summernote">{{ $page->terms_bn }}</textarea>
		                        </div>

                                <h2> Help </h2>
		                        <div class="mb-4">
		                          <label for="description_en" class="col-form-label" style="font-weight: bold;">Description:</label>
		                            <textarea name="help" id="description_en" cols="5" placeholder="Write page description english" class="form-control summernote">{{ $page->help}}</textarea>
		                            @error('description_en')
	                                    <p class="text-danger">{{$message}}</p>
	                                @enderror
		                        </div>
		                        <div class="mb-4 d-none">
		                          	<label for="description_bn" class="col-form-label" style="font-weight: bold;">Description (Bangla):</label>
		                            <textarea name="help_bn" id="description_bn" cols="5" placeholder="Write page description bangla" class="form-control summernote">{{ $page->help_bn }}</textarea>
		                        </div>
                                <h2> Shipping & Return </h2>
                                <div class="mb-4">
                                    <label for="description_en" class="col-form-label" style="font-weight: bold;">Description:</label>
                                    <textarea name="shipping_return" id="description_en" cols="5" placeholder="Write page description english" class="form-control summernote">{{ $page->shipping_return }}</textarea>
                                    @error('shipping_return')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
		                        <div class="row mb-4 justify-content-sm-end">
									<div class="col-lg-3 col-md-4 col-sm-5 col-6">
										<input type="submit" class="btn btn-primary" value="Submit">
									</div>
								</div>
		                    </form>
		                </div>
		            </div>
		            <!-- .row // -->
		        </div>
		        <!-- card body .// -->
		    </div>
		    <!-- card .// -->
    	</div>
    </div>
</section>

@endsection
