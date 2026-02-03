@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<section class="content-main">
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="content-header">
                <h2 class="content-title">Slider Edit</h2>
                <div class="">
                    <a href="{{ route('slider.index') }}" class="btn btn-primary p-3" title="Slider List"><i class="fa fa-list"></i> </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('slider.update', $slider->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                   <label for="title_en" class="col-form-label col-md-2" style="font-weight: bold;"> Title:</label>
                                    <input class="form-control" id="title_en" type="text" name="title_en" placeholder="Write Slider Title English"  value="{{ $slider->title_en }}">
                                </div>
                                <div class="mb-4 d-none">
                                  <label for="title_bn" class="col-form-label col-md-2" style="font-weight: bold;"> Title (Bangla):</label>
                                    <input class="form-control" id="title_bn" type="text" name="title_bn" placeholder="Write Slider Title bangla"  value="{{ $slider->title_bn }}">
                                </div>
                                <div class="mb-4">
                                  <label for="slider_url" class="col-form-label col-md-2" style="font-weight: bold;"> Slider Url:</label>
                                    <input class="form-control" id="slider_url" type="text" name="slider_url" placeholder="Write Slider Url"  value="{{ $slider->slider_url }}">
                                </div>

                                <div class="mb-4">
                                  <label for="description_en" class="col-form-label col-md-3" style="font-weight: bold;">Description:</label>
                                    <textarea name="description_en" id="description_en" cols="5" placeholder="Write Slider description english" class="form-control " >{{ $slider->description_en }}</textarea>
                                    @error('description_en')
		                            	<span class="text-danger">{{ $message }}</span>
		                            @enderror
                                </div>
                                <div class="mb-4 d-none">
                                    <label for="description_bn" class="col-form-label col-md-3" style="font-weight: bold;">Description (Bangla):</label>
                                    <textarea name="description_bn" id="description_bn" cols="5" placeholder="Write Slider description english" class="form-control " >{{ $slider->description_bn }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <img id="showImage" class="rounded avatar-lg" src="{{ asset($slider->slider_img) }}" alt="Card image cap" width="100px" height="80px;">
                                </div>
                                <div class="mb-4">
                                    <label for="image" class="col-form-label col-md-2" style="font-weight: bold;">Cover Photo:</label>
                                    <input name="slider_img" class="form-control" type="file" id="image">
                                </div>
                                <div class=" mb-4">
                                    <label for="position" class="col-form-label" style="font-weight: bold;"> Type:</label>
                                    <div class="custom_select">
                                        <select class="form-control select-active w-100 form-select select-nice" name="type" required>
                                            <option value="1" {{$slider->type == 1 ? 'selected':''}}>Header Slider</option>
                                            <option value="2" {{$slider->type == 2 ? 'selected':''}}>Middle Slider</option>
                                            {{--                                            <option value="3">Middle Banner 2</option>--}}
                                            {{--                                            <option value="0">Footer</option>--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1" {{ $slider->status == 1 ? 'checked': '' }} >
                                        <label class="form-check-label cursor" for="status">Status</label>
                                    </div>
                                </div>
                                <div class="row mb-4 justify-content-sm-end">
                                    <div class="col-lg-3 col-md-4 col-sm-5 col-6">
                                        <input type="submit" class="btn btn-primary" value="Update">
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
