@extends('FrontEnd.master')
@section('content')
<main>
    <section class="container my-5">
        <div class="row p-3">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12 mt-4">
                        <img src="assect/img/become/Becoming_an_online_seller_1.png" alt="">
                    </div>
                    <div class="col-sm-12 mt-4">
                        <img src="assect/img/become/Becoming_an_online_seller_2.jpg" alt="">
                    </div>
                </div>
            </div>

            <div class="col-sm-6 justify-content-sm-end">
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="https://www.estoreclassic.com/admin/vendor"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="HwbCvlQ3Lhv6McxED8C2klesunGes1kxne3gvgIO">
                            <div class="mb-4">
                                <label for="shop_name" class="col-form-label col-md-4" style="font-weight: bold;">
                                    Shop Name : <span class="text-danger">*</span></label>
                                <input class="form-control" id="shop_name" type="text" name="shop_name"
                                    placeholder="Write vendor shop name" value="">
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="col-form-label col-md-4" style="font-weight: bold;">
                                    Phone : <span class="text-danger">*</span></label>
                                <input class="form-control" id="phone" type="text" name="phone"
                                    placeholder="Write vendor phone number" value="">
                            </div>

                            <div class="mb-4">
                                <label for="email" class="col-form-label col-md-4" style="font-weight: bold;">
                                    Email : <span class="text-danger">*</span></label>
                                <input class="form-control" id="email" type="email" name="email"
                                    placeholder="Write vendor email address" value="">
                            </div>

                            <div class="mb-4">
                                <label for="address" class="col-form-label col-md-4"
                                    style="font-weight: bold;">Address : <span class="text-danger">*</span></label>
                                <input class="form-control" id="address" type="text" name="address"
                                    placeholder="Write vendor address" value="">
                            </div>

                            <div class="mb-4">
                                <label for="commission" class="col-form-label col-md-4"
                                    style="font-weight: bold;">Commission (Optional):</label>
                                <input class="form-control" id="commission" type="text" name="commission"
                                    placeholder="Write vendor commission" value="">
                            </div>

                            <div class="mb-4">
                                <label for="description" class="col-form-label col-md-4"
                                    style="font-weight: bold;">Description :</label>
                                <textarea name="description" id="description" cols="5"
                                    placeholder="Write vendor description" class="form-control "></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <img id="showImage" class="rounded avatar-lg"
                                            src="https://www.estoreclassic.com/upload/no_image.jpg"
                                            alt="Card image cap" width="100px" height="80px;">
                                    </div>
                                    <div class="mb-4">
                                        <label for="image" class="col-form-label" style="font-weight: bold;">Shop
                                            Profile: <span class="text-danger">*</span></label>
                                        <input name="shop_profile" class="form-control" type="file" id="image">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <img id="showImage2" class="rounded avatar-lg"
                                            src="https://www.estoreclassic.com/upload/no_image.jpg"
                                            alt="Card image cap" width="100px" height="80px;">
                                    </div>
                                    <div class="mb-4">
                                        <label for="image2" class="col-form-label" style="font-weight: bold;">Shop
                                            Cover Photo: <span class="text-danger">*</span></label>
                                        <input name="shop_cover" class="form-control" type="file" id="image2">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <img id="showImage3" class="rounded avatar-lg"
                                            src="https://www.estoreclassic.com/upload/no_image.jpg"
                                            alt="Card image cap" width="100px" height="80px;">
                                    </div>
                                    <div class="mb-4">
                                        <label for="image3" class="col-form-label" style="font-weight: bold;">Nid
                                            Card:</label>
                                        <input name="nid" class="form-control" type="file" id="image3">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <img id="showImage4" class="rounded avatar-lg"
                                            src="https://www.estoreclassic.com/upload/no_image.jpg"
                                            alt="Card image cap" width="100px" height="80px;">
                                    </div>
                                    <div class="mb-4">
                                        <label for="image4" class="col-form-label" style="font-weight: bold;">Trade
                                            license:</label>
                                        <input name="trade_license" class="form-control" type="file" id="image4">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <div class="col-md-6">
                                    <label for="password" class="col-form-label" style="font-weight: bold;">
                                        Password : <span class="text-danger">*</span></label>
                                    <input class="form-control" id="password" type="password" name="password"
                                        placeholder="Write vendor Password">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" style="font-weight: bold;"
                                        for="rtpassword">Confirm Password: <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" placeholder="Confirm Password" type="password"
                                        name="password_confirmation" id="rtpassword" />
                                </div>
                            </div>
                            <!-- form-group// -->

                            <div class="mb-4">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="form-check-input me-2 cursor" name="status"
                                        id="status" checked value="1">
                                    <label class="form-check-label cursor" for="status">Status</label>
                                </div>
                            </div>

                            <div class="row mb-4 justify-content-sm-end">
                                <div class="col-lg-3 col-md-4 col-sm-5 col-6">
                                    <input type="submit" class="btn btn-primary px-3" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection
