@extends('admin.admin_master')
@section('admin')
<section class="content-main">
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="content-header">
                <h2 class="content-title">Special Feature Edit</h2>
                <div class="">
                    <a href="{{ route('special.feature.all') }}" class="btn btn-primary p-3" title="Special Feature List"><i class="fa fa-list"></i> </a>
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
                            <form method="post" action="{{ route('special.feature.update',$special_feature->id) }}">
                                @csrf

                                <div class="mb-4">
                                    <label for="name_en" class="col-form-label" style="font-weight: bold;"> Name:</label>
                                    <input class="form-control" id="name_en" type="text" name="name_en" placeholder="Write special feature name english" value="{{ $special_feature->name_en }}">
                                    @error('name_en')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="mb-4 d-none">
                                   <label for="name_bn" class="col-form-label" style="font-weight: bold;"> Name (Bangla):</label>
                                    <input class="form-control" id="name_bn" type="text" name="name_bn" placeholder="Write special feature name bangla" value="{{ $special_feature->name_bn }}">
                                </div>


                                <div class="mb-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="form-check-input me-2 cursor" name="status" id="status" value="1" {{ $special_feature->status == 1 ? 'checked': '' }}>
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
