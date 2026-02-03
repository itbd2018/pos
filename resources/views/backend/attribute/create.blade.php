@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="content-header">
                <h2 class="content-title">Attribute Add</h2>
                <div>
                    <a href="{{ route('attribute.index') }}" class="btn btn-primary p-3" title="Attribute List"><i class="fa fa-list"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-8 mx-auto">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="text-white">Attribute</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('attribute.store') }}" enctype="multipart/form-data">
                    	@csrf
                        <div class="mb-4">
                            <label for="name" class="col-form-label col-md-2" style="font-weight: bold;"> Name:</label>
                            <input class="form-control" id="name" type="text" name="name" placeholder="Write attribute name" value="{{old('name')}}">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="row mb-4 justify-content-sm-end">
							<div class="col-4">
								<input type="submit" name="" class="btn btn-primary" value="Submit">
							</div>
						</div>
                    </form>
                </div>
            </div>
            <!-- card end// -->
        </div>
    </div>
</section>
@endsection
