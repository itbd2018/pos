{{-- //new script --}}
<script src="{{ asset('FrontEnd') }}/assets/js/jquery.min.js"></script>
<script src="{{ asset('FrontEnd') }}/assets/js/popper.min.js"></script>
<script src="{{ asset('FrontEnd') }}/assets/js/bootstrap.min.js"></script>
<script src="{{ asset('FrontEnd') }}/assets/js/ion.rangeSlider.min.js"></script>
<script src="{{ asset('FrontEnd') }}/assets/js/slick.js"></script>
<script src="{{ asset('FrontEnd') }}/assets/js/slider-bg.js"></script>
<script src="{{ asset('FrontEnd') }}/assets/js/lightbox.js"></script>
<script src="{{ asset('FrontEnd') }}/assets/js/smoothproducts.js"></script>
<script src="{{ asset('FrontEnd') }}/assets/js/snackbar.min.js"></script>
<script src="{{ asset('FrontEnd') }}/assets/js/jQuery.style.switcher.js"></script>
<script src="{{ asset('FrontEnd') }}/assets/js/custom.js"></script>

{{-- //end new script --}}
<!-- Jquery -->
{{-- <script src="{{ asset('FrontEnd') }}/assect/js/jquery-3.7.1.js"></script> --}}

<!-- Owl Carousel -->
<script src="{{ asset('FrontEnd') }}/assect/js/owl.carousel.min.js"></script>
<script src="{{ asset('FrontEnd') }}/assets/js/select2.min.js"></script>
<!-- Count down-->
<script src="{{ asset('FrontEnd') }}/assets/js/counterup.js"></script>
<script src="{{ asset('FrontEnd') }}/assets/js/jquery.countdown.min.js"></script>
<!-- Count down-->
<script src="{{ asset('FrontEnd') }}/assect/js/jquery.elevatezoom.js"></script>
<!-- Custom Js -->
{{-- <script src="{{ asset('FrontEnd') }}/assect/js/custom.js"></script> --}}
<script src="{{ asset('FrontEnd') }}/assect/js/sweetalert2@11.js"></script>
<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        // Hide the "up" button initially
        $('.back-to-top').hide();

        // Show or hide the "up" button based on scroll position
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) { // You can adjust the scroll position threshold as needed
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        });

        // Scroll to top when the button is clicked
        $('.back-to-top').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });
</script>
<script>
    function buyNow(id, qty = 0) {
        // alert();
        addToCartDirect(id, true, qty);
    }

    function addToCartDirect(id, redirectToCheckout = false, qty = null) {
        var product_name = $('#' + id + '-product_pname').val();
        var quantity = qty > 1 ? qty : 1;

        // Step 1: Check if product already exists in cart
        $.ajax({
            type: 'GET',
            url: '/cart/check/' + id,
            success: function(res) {
                if (redirectToCheckout && res.exists) {
                    // If product already exists and it's Buy Now, skip adding — redirect immediately
                    window.location.href = '/checkout';
                    // window.location.href = '/login-status/check';
                    return;
                }

                // var options = $('#choice_form').serializeArray();
                // var jsonString = JSON.stringify(options);
                // console.log(options);
                // console.log(id, redirectToCheckout, qty)
                // var product_name = $('#pname').val();
                // var id = $('#product_id').val();
                // var price = $('#product_price').val();
                // var color = $('#color option:selected').val();
                // var size = $('#size option:selected').val();
                // var quantity = $('#qty').val();
                // var varient = $('#pvarient').val();

                // Step 2: Proceed to add to cart (normal flow)
                $.ajax({
                    type: 'POST',
                    url: '/cart/data/store/' + id,
                    data: {

                        // color: color,
                        // size: size,
                        // product_price: price,
                        // product_varient: varient,
                        // options: jsonString,

                        quantity: quantity,
                        product_name: product_name,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        miniCart(); // refresh sidebar & header count
                        $('#closeModel').click(); // close modal if any

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1200
                        });

                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                                icon: 'success',
                                title: data.success
                            });

                            if (redirectToCheckout) {
                                window.location.href = '/checkout';
                                // window.location.href = '/login-status/check';
                            }
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.error
                            });
                        }
                    }
                });
            }
        });
    }

    /* ---------------- Buy Now ---------------- */
    function buyNow(id, qty = 0) {
        addToCartDirect(id, true, qty);
    }


    function miniCart() {
        $.ajax({
            type: 'GET',
            url: '/product/mini/cart',
            dataType: 'json',
            success: function(response) {
                // alert(response);
                //checkout();
                $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartSubTotalShi').val(response.cartTotal);
                $('.cartQty').text(Object.keys(response.carts).length);
                $('#total_cart_qty').text(Object.keys(response.carts).length);

                var miniCart = "";

                if (Object.keys(response.carts).length > 0) {
                    $.each(response.carts, function(key, value) {
                        //console.log(value);
                        var slug = value.options.slug;
                        var base_url = window.location.origin;
                        miniCart += `

                            <div class="item-cart mb-20">
                                            <div class="cart-image"><img src="/${value.options.image}" alt="Ecom"></div>
                                    <div class="cart-info">
                                      <a  id="${value.rowId}" onclick="miniCartRemove(this.id)" style='float:right;padding: 2px;'><i class="fa-solid fa-xmark"></i></a>
                                      <a class="font-sm-bold color-brand-3" href="${base_url}/product-details/${slug}">${value.name}</a>
                                     <p><span class="color-brand-2 font-sm-bold">${value.qty} x ${value.price}</span></p>
                            </div>
                        </div>`

                    });

                    $('#miniCart').html(miniCart);
                    $('#miniCart_empty_btn').hide();
                    $('#miniCart_btn').show();
                } else {
                    html = '<h4 class="text-center">Cart empty!</h4>';
                    $('#miniCart').html(html);
                    $('#miniCart_btn').hide();
                    $('#miniCart_empty_btn').show();
                }
            }
        });
    }
    /* ============ Function Call ========== */
    miniCart();
</script>
<script>
    function search_result_hide() {
        $(".searchProducts").slideUp();
    }

    function search_result_show() {
        $(".searchProducts").slideDown();
    }

    $("body").on("keyup", ".search", function() {
        // alert('ok');
        let text = $(".search").val();
        if (text.length == 0) {
            text = $('#mobile_search').val();
        }
        console.log(text);
        let category_id = $("#searchCategory").val();
        // alert(category_id);
        // console.log(text);

        if (text.length > 0) {
            $.ajax({
                data: {
                    search: text,
                },
                url: "/search-product",
                method: 'get',
                beforSend: function(request) {
                    return request.setReuestHeader('X-CSRF-Token', ("meta[name='csrf-token']"))

                },
                success: function(result) {
                    console.log(result);
                    // alert('ok');
                    $(".searchProducts").html(result);
                }

            }); // end ajax
        } // end if
        if (text.length < 1) $(".searchProducts").html("");
    }); // end function
</script>
<script>
    document.getElementById('downloadButton').addEventListener('click', function() {
        // Get the HTML content of your invoice
        var invoiceContent = document.getElementById('downloadinvoice').innerHTML;

        // Convert HTML to PDF
        html2pdf(invoiceContent, {
            margin: 10,
            filename: 'invoice.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        });
    });
</script>
<script>
    function newImg(e) {
        // alert();

        e.src = $('#header_img_alter').val();
    }

    function oldImg(e) {
        // alert();
        e.src = $('#header_img').val();
    }
</script>
<script>
    /* ============= Start Product View With Modal ========== */
    function productView(id) {
        // alert($('#attribute_alert'+id).text());
        $.ajax({
            type: 'GET',
            url: '/product/view/modal/' + id,
            dataType: 'json',
            success: function(data) {
                @if (session()->get('language') == 'bangla')
                    $('#product_name').text(data.product.name_bn);
                    $('#pcategory').text(data.product.category.name_bn);

                    if (data.product.brand_id && data.product.brand_id > 0) {
                        $('#pbrand').text(data.product.brand.name_bn);
                    } else {
                        $('#pbrand').text('নন ব্র্যান্ড');
                    }
                @else
                    $('#product_name').text(data.product.name_en);
                    $('#pcategory').text(data.product.category.name_en);
                    if (data.product.brand_id && data.product.brand_id > 0) {
                        $('#pbrand').text(data.product.brand.name_en);
                    } else {
                        $('#pbrand').text('N/A');
                    }
                @endif

                $('#pname').val(data.product.name_en);
                $('#product_id').val(id);
                $('#pcode').text(data.product.product_code);


                $('#pimage').attr('src', '/' + data.product.product_thumbnail);
                $('#stock_qty').val(data.product.stock_qty);
                $('#minimum_buy_qty').val(data.product.minimum_buy_qty);

                $('#pavailable').hide();
                $('#pstockout').hide();

                /* =========== Start Product Price ========= */
                var discount = 0;
                if (data.product.discount_price > 0) {
                    if (data.product.discount_type == 1) {
                        discount = data.product.discount_price;
                        $('#pprice').text(data.product.regular_price - discount);
                        $('#oldprice').text('৳' + (data.product.regular_price));
                    } else if (data.product.discount_type == 2) {
                        discount = data.product.discount_price * data.product.regular_price / 100;
                        $('#pprice').text(data.product.regular_price - discount);
                        $('#oldprice').text('৳' + (data.product.regular_price));
                    }
                } else {
                    $('#pprice').text(data.product.regular_price);
                    $('#oldprice').text('');
                }

                $('#discount_amount').val(discount);

                if (data.product.stock_qty > 0) {
                    $('#pavailable').show();
                } else {
                    $('#pstockout').show();
                }
                /* =========== End Product Price ========= */

                /* ============ Start Color ============= */
                /* ============ Color empty ============= */
                // $('select[name ="color"]').empty();
                //console.log(data.attributes);
                var i = 0;
                var html = '';
                $.each(data.attributes, function(key, value) {

                    i++;
                    html += '<div class="attr-detail attr-size mb-30 col-12">';
                    html += '<strong class="mr-10">' + value.name + ': </strong>';
                    html += '<input type="hidden" name="attribute_ids[]" id="attribute_id_' + i +
                        '" value="' + value.id + '">';
                    html += '<input type="hidden" name="attribute_names[]" id="attribute_name_' +
                        i + '" value="' + value.name + '">';
                    html += '<input type="hidden" id="attribute_check_' + i + '" value="0">';
                    html += '<input type="hidden" id="attribute_check_attr_' + i + '" value="0">';
                    html += '<div class="list-filter size-filter font-small">';
                    var j = 1;
                    $.each(value.values, function(key, attr_value) {
                        if (key == 0) {
                            html += '<label  id="attr_val_li_' + value.id + value.name +
                                '_' + attr_value + '" class="radio-inline attr_val_li_' +
                                value.id + value.name + '">';
                            html += '<input type="radio" id="attr_' + value.id + value
                                .name + '_' + attr_value + '" name="option_' + i +
                                '" onclick="selectAttributeModal(this.id, ' + i +
                                ')" style="border: 1px solid red; position:">' +
                                attr_value + '';
                            html += '<input type="hidden" id="choice_option_attr_' + value
                                .id + value.name + '" value="' + attr_value + '">';
                            html += '</label>';
                        } else {
                            html += '<label id="attr_val_li_' + value.id + value.name +
                                '_' + attr_value + '" class="radio-inline attr_val_li_' +
                                value.id + value.name + '" style="margin-left: 5px;">';
                            html += '<input type="radio" id="attr_' + value.id + value
                                .name + '_' + attr_value + '" name="option_' + i +
                                '" onclick="selectAttributeModal(this.id, ' + i +
                                ')" style="border: 1px solid red;">' + attr_value + '';
                            html += '<input type="hidden" id="choice_option_attr_' + value
                                .id + value.name + '" value="' + attr_value + '">';
                            html += '</label>';
                        }
                        j++;

                    });
                    html += '<input type="hidden" name="attribute_options[]" id="' + value.id +
                        value.name + '" class="attr_value_' + i + '">';
                    html += '</div>';
                    html += '</div><br>';
                });
                html += '<input type="hidden" id="total_attributes" value="' + data.attributes.length +
                '">';
                $('#attributes').html(html);

                /* ========== Start Stock Option ========= */
                if (data.product.product_qty > 0) {
                    $('#aviable').text('');
                    $('#stockout').text('');
                    $('#aviable').text('available');

                } else {
                    $('#aviable').text('');
                    $('#stockout').text('');
                    $('#stockout').text('stockout');
                }
                /* ========== End Stock Option ========== */

                /* ========= Start Add To Cart Product id ======== */
                $('#product_id').val(id);
                $('#qty').val(data.product.minimum_buy_qty);
                /* ========== End Add To Cart Product id ======== */
            }
        });
    }
    /* ============= End Product View With Modal ========== */
    function addToCart() {
        // alert('ok');
        var total_attributes = parseInt($('#total_attributes').val());
        // alert(total_attributes);
        // var checkNotSelected = 0;
        // var checkAlertHtml = '';
        // for (var i = 1; i <= total_attributes; i++) {
        //     var checkSelected = parseInt($('#attribute_check_' + i).val());
        //     if (checkSelected == 0) {
        //         checkNotSelected = 1;
        //         checkAlertHtml += `<div class="attr-detail mb-5">
        // 								<div class="alert alert-danger d-flex align-items-center" role="alert">
        // 									<div>
        // 										<i class="fa fa-warning mr-10"></i> <span> Select ` + $('#attribute_name_' + i).val() + `</span>
        // 									</div>
        // 								</div>
        // 							</div>`;
        //     }
        // }
        // if (checkNotSelected == 1) {
        //     $('#qty_alert').html('');
        //     //$('#attribute_alert').html(checkAlertHtml);
        //     $('#attribute_alert').html(`<div class="attr-detail mb-5">
        // 								<div class="alert alert-danger d-flex align-items-center" role="alert">
        // 									<div>
        // 										<i class="fa fa-warning mr-10"></i> <span> Select all attributes</span>
        // 									</div>
        // 								</div>
        // 							</div>`);
        //     return false;
        // }
        $('.size-filter li').removeClass("active");
        var product_name = $('#pname').val();
        var id = $('#product_id').val();
        var price = $('#product_price').val();
        var color = $('#color option:selected').val();
        var size = $('#size option:selected').val();
        var quantity = $('#qty').val();
        var varient = $('#pvarient').val();

        console.log(price);
        var min_qty = parseInt($('#minimum_buy_qty').val());
        if (quantity < min_qty) {
            $('#attribute_alert').html('');
            $('#qty_alert').html(`<div class="attr-detail mb-5">
											<div class="alert alert-danger d-flex align-items-center" role="alert">
												<div>
													<i class="fa fa-warning mr-10"></i> <span> Minimum quantity ` + min_qty + ` required.</span>
												</div>
											</div>
										</div>`);
            return false;
        }
        // console.log(min_qty);
        var p_qty = parseInt($('#stock_qty').val());
        // if(quantity > p_qty){
        //     $('#stock_alert').html(`<div class="attr-detail mb-5">
        // 								<div class="alert alert-danger d-flex align-items-center" role="alert">
        // 									<div>
        // 										<i class="fa fa-warning mr-10"></i> <span> Not enough stock.</span>
        // 									</div>
        // 								</div>
        // 							</div>`);
        //     return false;
        // }


        // alert(varient);

        var options = $('#choice_form').serializeArray();
        var jsonString = JSON.stringify(options);
        console.log(options);

        // Start Message
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 1200
        });

        $.ajax({
            type: 'POST',
            url: '/cart/data/store/' + id,
            dataType: 'json',
            data: {
                _token: '{!! csrf_token() !!}',
                color: color,
                size: size,
                quantity: quantity,
                product_name: product_name,
                product_price: price,
                product_varient: varient,
                options: jsonString,
            },
            success: function(data) {
                // console.log(data);
                miniCart();
                $('#closeModel').click();

                // Start Sweertaleart Message
                if ($.isEmptyObject(data.error)) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1200
                    })

                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })

                    $('#qty').val(min_qty);
                    $('#pvarient').val('');

                    for (var i = 1; i <= total_attributes; i++) {
                        $('#attribute_check_' + i).val(0);
                    }

                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1200
                    })

                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })

                    $('#qty').val(min_qty);
                    $('#pvarient').val('');

                    for (var i = 1; i <= total_attributes; i++) {
                        $('#attribute_check_' + i).val(0);
                    }
                }
                // Start Sweertaleart Message
                var buyNowCheck = $('#buyNowCheck').val();
                //alert(buyNowCheck);
                if (buyNowCheck && buyNowCheck == 1) {
                    $('#buyNowCheck').val(0);
                    window.location = '/checkout';
                }

            }
        });
    }

    function selectAttribute(id, value, pid, position) {
        // console.log(id, value, position, pid);
        $('#' + id).val(value);
        var checkVal = $('#attribute_check_' + position).val();
        var checkProduct = $('#attribute_check_attr_' + position).val();
        if (checkVal == 1) {
            if (checkProduct == value) {
                $('#attribute_check_' + position).val(0);
            } else {
                $('#attribute_check_attr_' + position).val(value);
            }
        } else {
            $('#attribute_check_' + position).val(1);
            $('#attribute_check_attr_' + position).val(value);
        }

        var varient = '';
        var total = $('#total_attributes').val();
        for (var i = 1; i <= total; i++) {
            var varnt = $('.attr_value_' + i).val();
            if (varnt != '') {
                if (i == 1) {
                    varient += varnt;
                } else {
                    varient += '-' + varnt;
                }
            }
        }

        $.ajax({
            type: 'GET',
            url: '/varient-price/' + pid + '/' + varient,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                if (data && data != 'na') {
                    //$('.current-price').text('৳'+data);
                    var discount = $('#discount_amount').val();
                    console.log(discount);
                    if (discount > 0) {
                        console.log(discount, data.price - discount);
                        $('.product_price').text('৳' + (data.price - discount));
                        $('.old-price').text('৳' + data.price);
                        $('#product_price').val(data.price - discount);
                    } else {
                        $('.current-price').text('৳' + data.price);
                        $('.old-price').text('৳' + data.price);
                        $('#product_price').val(data.price);
                    }
                    // console.log($('#product_price').val());
                    $('#pvarient').val(varient);
                    //alert(discount);
                    $('#product_zoom_img').attr("src", window.location.origin + '/' + data.image);
                    $('#product_zoom_img').attr("srcset", window.location.origin + '/' + data.image);
                }
            }
        });
    }

    function selectAttributeModal(id, position) {
        const idArray = id.split("_");

        var value = idArray[2];
        var pid = $('#product_id').val();
        $('#' + idArray[1]).val(value);

        $('.attr_val_li_' + idArray[1]).removeClass("active");
        $('#attr_val_li_' + idArray[1] + '_' + idArray[2]).addClass("active");

        var checkVal = $('#attribute_check_' + position).val();
        var checkProduct = $('#attribute_check_attr_' + position).val();
        //alert(position);
        if (checkVal == 1) {
            if (checkProduct == value) {
                $('#attribute_check_' + position).val(0);
            } else {
                $('#attribute_check_attr_' + position).val(value);
            }
        } else {
            $('#attribute_check_' + position).val(1);
            $('#attribute_check_attr_' + position).val(value);
        }


        var varient = '';
        var total = $('#total_attributes').val();
        for (var i = 1; i <= total; i++) {
            var varnt = $('.attr_value_' + i).val();
            if (varnt != '') {
                if (i == 1) {
                    varient += varnt;
                } else {
                    varient += '-' + varnt;
                }
            }
        }

        //alert(varient);

        $.ajax({
            type: 'GET',
            url: '/varient-price/' + pid + '/' + varient,
            dataType: 'json',
            success: function(data) {
                //console.log(data);
                if (data && data != 'na') {
                    //$('.current-price').text('৳'+data);
                    var discount = $('#discount_amount').val();
                    if (discount > 0) {
                        $('#pprice').text(data.price - discount);
                        $('#oldprice').text('৳' + (data.price));
                        $('#product_price').val(data.price - discount);
                    } else {
                        $('#pprice').text(data.price);
                        $('#product_price').val(data.price);
                    }
                    $('#pvarient').val(varient);
                    //alert(discount);
                    $('#pimage').attr("src", window.location.origin + '/' + data.image);
                }
            }
        });

    }

    function test() {

        var total_attributes = parseInt($('#total_attributes').val());

        // alert(total_attributes);
        var checkNotSelected = 0;
        var checkAlertHtml = '';
        for (var i = 1; i <= total_attributes; i++) {
            var checkSelected = parseInt($('#attribute_check_' + i).val());
            if (checkSelected == 0) {
                checkNotSelected = 1;
                checkAlertHtml += `<div class="attr-detail mb-5">
        								<div class="alert alert-danger d-flex align-items-center" role="alert">
        									<div>
        										<i class="fa fa-warning mr-10"></i> <span> Select ` + $('#attribute_name_' + i).val() + `</span>
        									</div>
        								</div>
        							</div>`;
            }
        }
        $('.size-filter li').removeClass("active");
        var product_name = $('#pname').val();
        var id = $('#product_id').val();
        var price = $('#product_price').val();
        var color = $('#color option:selected').val();
        var size = $('#size option:selected').val();
        var quantity = $('#qty').val();
        var varient = $('#pvarient').val();

        console.log(price);
        if (checkNotSelected == 1) {
            $('#qty_alert').html('');
            //$('#attribute_alert').html(checkAlertHtml);
            $('#attribute_alert').html(`<div class="attr-detail mb-5">
        								<div class="alert alert-danger d-flex align-items-center" role="alert">
        									<div>
        										<i class="fa fa-warning mr-10"></i> <span> Select all attributes</span>
        									</div>
        								</div>
        							</div>`);
            // console.log($('#attribute_alert'+id).text());
            setTimeout(function() {
                $('#attribute_alert').empty();
            }, 1000);
            return false;
        }

        var min_qty = parseInt($('#minimum_buy_qty').val());
        if (quantity < min_qty) {
            $('#attribute_alert').html('');
            $('#qty_stock_alert').html(`<div class="attr-detail mb-5">
											<div class="alert alert-danger d-flex align-items-center" role="alert">
												<div>
													<i class="fa fa-warning mr-10"></i> <span> Minimum quantity ` + min_qty + ` required.</span>
												</div>
											</div>
										</div>`);
            setTimeout(function() {
                $('#qty_stock_alert').empty();
            }, 1000);
            return false;
        }
        // console.log(min_qty);
        var p_qty = parseInt($('#stock_qty').val());
        if (quantity > p_qty) {
            $('#qty_stock_alert').html(`<div class="attr-detail mb-5">
        								<div class="alert alert-danger d-flex align-items-center" role="alert">
        									<div>
        										<i class="fa fa-warning mr-10"></i> <span> Not enough stock.</span>
        									</div>
        								</div>
        							</div>`);

            setTimeout(function() {
                $('#qty_stock_alert').empty();
            }, 1000);
            return false;
        }


        // alert(varient);

        var options = $('#choice_form').serializeArray();
        var jsonString = JSON.stringify(options);
        console.log(options);

        // Start Message
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 1200
        });

        $.ajax({
            type: 'POST',
            url: '/cart/data/store/' + id,
            dataType: 'json',
            data: {
                _token: '{!! csrf_token() !!}',
                color: color,
                size: size,
                quantity: quantity,
                product_name: product_name,
                product_price: price,
                product_varient: varient,
                options: jsonString,
            },
            success: function(data) {
                // console.log(data);
                miniCart();
                $('#closeModel').click();

                // Start Sweertaleart Message
                if ($.isEmptyObject(data.error)) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1200
                    })

                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })

                    $('#qty').val(min_qty);
                    $('#pvarient').val('');

                    for (var i = 1; i <= total_attributes; i++) {
                        $('#attribute_check_' + i).val(0);
                    }

                } else {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1200
                    })

                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })

                    $('#qty').val(min_qty);
                    $('#pvarient').val('');

                    for (var i = 1; i <= total_attributes; i++) {
                        $('#attribute_check_' + i).val(0);
                    }
                }
                // Start Sweertaleart Message
                var buyNowCheck = $('#buyNowCheck').val();
                //alert(buyNowCheck);
                if (buyNowCheck && buyNowCheck == 1) {
                    $('#buyNowCheck').val(0);
                    window.location.href = '/checkout';
                    // window.location.href = '/login-status/check';
                }

            }
        });
    }
</script>

<script>
    $('#buy_now').on('click', function() {
        // alert('ok');
        var qty = $('.qty-val').val();
        // alert(qty);
        var id = $('#product_id').val();
        buyNow(id, qty);
    });

    function buyProduct() {
        $('#buyNowCheck').val(1);
        test();
    }

    function cartRemove(id) {
        $.ajax({
            type: 'GET',
            url: '/cart-remove/' + id,
            dataType: 'json',
            success: function(data) {
                cart();
                miniCart();


                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message
            }
        });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
