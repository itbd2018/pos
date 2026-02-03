@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="content-header">
                <h2 class="content-title">Personal Details</h2>
                <div class="">
                    <a href="{{ route('vendor.index') }}" class="btn btn-primary p-3" title="Vendor List"><i class="fa fa-list"></i> </a>
                </div>
            </div>

        </div>
    </div>
    <div class="row justify-content-center">
    	<div class="col-sm-8">
    		<div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                	{{-- @if(count($errors))
		                        @foreach ($errors->all() as $error)
		                           <p class="alert alert-danger alert-dismissible fade show"> {{ $error}} </p>
		                        @endforeach
	                        @endif --}}
		                    {{-- <form method="POST" action="{{ route('vendor.update',$vendor->id) }}" enctype="multipart/form-data">
		                    	@csrf
		                    	@method('PUT')
                                <div class="mb-4">
                                    <label for="shop_name" class="col-form-label col-md-4" style="font-weight: bold;"> Shop owner Name : <span class="text-danger">*</span></label>
                                      <input class="form-control" id="shop_name" type="text" name="shop_owner_name" placeholder="Write vendor Owner name" value="{{$vendor->shop_owner_name}}">
                                      @error('shop_name')
                                          <p class="text-danger">{{$message}}</p>
                                      @enderror
                                  </div>
		                        <div class="mb-4">
		                          <label for="shop_name" class="col-form-label col-md-4" style="font-weight: bold;"> Shop Name : <span class="text-danger">*</span></label>
		                            <input class="form-control" id="shop_name" type="text" name="shop_name" placeholder="Write vendor shop name" value="{{$vendor->shop_name}}">
									@error('shop_name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
		                        </div>

								<div class="mb-4">
		                          <label for="phone" class="col-form-label col-md-4" style="font-weight: bold;"> Phone : <span class="text-danger">*</span></label>
		                            <input class="form-control" id="phone" type="text" name="phone" placeholder="Write vendor phone number" value="{{$vendor->user->phone}}">
									@error('phone')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
		                        </div>

								<div class="mb-4">
		                          <label for="email" class="col-form-label col-md-4" style="font-weight: bold;"> Email : <span class="text-danger">*</span></label>
		                            <input class="form-control" id="email" type="email" name="email" placeholder="Write vendor email address" value="{{$vendor->user->email}}">
									@error('email')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
		                        </div>

		                        <div class="mb-4">
		                          <label for="address" class="col-form-label col-md-4" style="font-weight: bold;">Address : <span class="text-danger">*</span></label>
		                            <input class="form-control" id="address" type="text" name="address" placeholder="Write vendor address" value="{{$vendor->address}}">
									@error('address')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
		                        </div>
                                <div class="mb-4">
                                    <label for="discount_type" class="col-form-label" style="font-weight: bold;">Comission Type:<span class="text-danger">*</span></label>
                                    <div class="custom_select">
                                        <select class="form-control select-active w-100 form-select select-nice" name="comission_type" required >
                                            <option value="1"<?php if ($vendor->comission_type == '1') echo "selected"; ?>>Flat</option>
                                            <option value="2"<?php if ($vendor->comission_type == '2') echo "selected"; ?>>Percent %</option>
                                        </select>
                                    </div>
		                        </div>

		                        <div class="mb-4">
		                          <label for="commission" class="col-form-label col-md-4" style="font-weight: bold;">Commission: <span class="text-danger">*</span></label>
		                            <input class="form-control" id="commission" type="text" required name="commission" placeholder="Write vendor commission" value="{{$vendor->commission}}">
		                        </div>

		                        <div class="mb-4">
		                          <label for="description" class="col-form-label col-md-4" style="font-weight: bold;">Description :</label>
		                            <textarea name="description" id="description" cols="5" placeholder="Write vendor description" class="form-control ">{{$vendor->description}}</textarea>
		                        </div>

		                        <div class="row">
		                        	<div class="col-md-6">
		                        		<div class="mb-4">
				                         	<label for="image" class="col-form-label" style="font-weight: bold;">Shop Profile: <span class="text-danger">*</span></label>
				                            <input name="shop_profile" class="form-control" type="file" id="image">
				                        </div>
				                        <div class="mb-4">
				                         	<img id="showImage" class="rounded avatar-lg" src="{{asset($vendor->shop_profile) }}" alt="Card image cap" width="100px" height="80px;">
				                        </div>
				                    </div>

				                    <div class="col-md-6">
				                    	<div class="mb-4">
				                         	<label for="image2" class="col-form-label" style="font-weight: bold;">Shop Cover Photo: <span class="text-danger">*</span></label>
				                            <input name="shop_cover" class="form-control" type="file" id="image2">
				                        </div>
				                        <div class="mb-4">
				                         	<img id="showImage2" class="rounded avatar-lg" src="{{asset($vendor->shop_cover) }}" alt="Card image cap" width="100px" height="80px;">
				                        </div>
				                    </div>
		                        </div>

		                       <div class="row">
		                       		<div class="col-md-6">
		                       			<div class="mb-4">
				                         	<label for="image3" class="col-form-label" style="font-weight: bold;">Nid Card:</label>
				                            <input name="nid" class="form-control" type="file" id="image3">
				                        </div>
				                         <div class="mb-4">
				                         	<img id="showImage3" class="rounded avatar-lg" src="{{asset($vendor->nid) }}" alt="Card image cap" width="100px" height="80px;">
				                        </div>
		                       		</div>

		                       		<div class="col-md-6">
		                       			<div class="mb-4">
				                         	<label for="image4" class="col-form-label" style="font-weight: bold;">Trade license:</label>
				                            <input name="trade_license" class="form-control" type="file" id="image4">
				                        </div>
				                         <div class="mb-4">
				                         	<img id="showImage4" class="rounded avatar-lg" src="{{asset($vendor->trade_license) }}" alt="Card image cap" width="100px" height="80px;">
				                        </div>
		                       		</div>
		                       </div>

		                        <div class="mb-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1" {{ $vendor->status == 1 ? 'checked': '' }} >
                                        <label class="form-check-label cursor" for="status">Status</label>
                                    </div>
                                </div>

		                        <div class="row mb-4 justify-content-sm-end">
									<div class="col-lg-3 col-md-4 col-sm-5 col-6">
										<input type="submit" class="btn btn-primary" value="Update">
									</div>
								</div>
		                    </form> --}}
							<table class="table table-bordered">
								<tr>
									<th>Full Name </th>
									<td>{{ $vendor->shop_owner_name }}</td>
								</tr>
								
								<tr>
									<th>Phone</th>
									<td>{{ $vendor->user->phone }}</td>
								</tr>
								<tr>
									<th>Email</th>
									<td>{{ $vendor->user->email }}</td>
								</tr>
								<tr>
									<th>Address</th>
									<td>{{ $vendor->address }}</td>
								</tr>
								
								<tr>
									<th>Profile Image</th>
									<td>
										<img src="{{ asset($vendor->shop_profile) }}" alt="Shop Profile" width="100" height="80">
									</td>
								</tr>
								<tr>
									<th>NID Card</th>
									<td>
										<img src="{{ asset($vendor->nid) }}" alt="NID Card" width="100" height="80">
									</td>
								</tr>
								
								<tr>
									<th>Status</th>
									<td>{{ $vendor->status == 1 ? 'Active' : 'Inactive' }}</td>
								</tr>
								<tr>
									<th>Appoval Button</th>
									<td>
										@if($vendor->status == 1)
										  <a href="{{ route('vendor.in_active',['id'=>$vendor->id]) }}">
											<span class="status badge rounded-pill alert-success">Active</span>
										  </a>
										@else
										  <a href="{{ route('vendor.active',['id'=>$vendor->id]) }}" > <span class="status badge rounded-pill alert-danger">Disable</span></a>
										@endif
									</td>
								</tr>
								
							</table>
							
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

@push('footer-script')
<!-- Shop Cover Photo Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image2').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage2').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <!-- Nid Card Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image3').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage3').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <!-- Trade license Show -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#image4').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage4').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush
