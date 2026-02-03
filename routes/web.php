<?php

use App\Http\Controllers\ReturningProductController;
use Illuminate\Support\Facades\Route;
//======= Use A Frontend Controller =======*/
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\AttributeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\UserController;
//use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\NagadController;
use App\Http\Controllers\Frontend\BkashController;
use App\Http\Controllers\Frontend\AamarpayController;
use App\Http\Controllers\Backend\SubscriberController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
//use App\Http\Controllers\Backend\CompareController;
use App\Http\Controllers\Frontend\PublicSslCommerzPaymentController;
use App\Http\Middleware\UserMiddleware;
// use PDF;
use App\Http\Controllers\Frontend\UserMessageController;
use App\Http\Controllers\Frontend\ReturnRequestController;
use Facade\FlareClient\Report;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------FrontendController------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/invoice', function () {
    return PDF::loadView('FrontEnd.page.check_list')->stream('invoice.pdf');
});

Route::get('/price-stock-quality',[ReportController::class, 'stockPriceReport'])->name('check_list');
Route::get('/stock/price/quality/pdf',[ReportController::class, 'downloadPdf'])->name('stock.quality.pdf');
Route::get('/stock/price/list/pdf',[ReportController::class, 'downloadStockListPdf'])->name('stock.price.list.pdf');
/*================== Frontend All Route ==============*/

Route::get('/', [AdminController::class, 'Index'])->name('login_form');

// Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/home2', [FrontendController::class, 'index2'])->name('home2');
// Route::get('/shop-grid', [FrontendController::class, 'shopgrid'])->name('shop.grid');

Route::middleware([UserMiddleware::class])->group(function () {
    Route::get('/dashboard',[UserController::class, 'index'])->name('dashboard');
    Route::get('/get-returning-product/{id}',[UserController::class, 'getReturningProduct'])->name('get-returning-product');
});

Route::get('/refresh-csrf', function() {
    return csrf_token();
});

/* ==================== Start User dashboard Route ================== */
// Route::get('/dashboard',[UserController::class, 'index'])->name('dashboard')->middleware('web');

/* ====================  User Order Route ================== */
Route::get('/user/orders/{invoice_no}',[UserController::class, 'orderView'])->name('order.view');
Route::get('/user/orders/download/{invoice_no}',[UserController::class, 'orderDownload'])->name('order.download');
/* ==================== End User dashboard Route ================== */


/*================== Multi Language All Routes ==============*/
Route::get('/language/bangla', [LanguageController::class, 'Bangla'])->name('bangla.language');

Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');

// All Category List start
Route::get('/categories',[CategoryController::class, 'index'])->name('category_list.index');
// All Category List end


/* =============== Product Search  ============= */
Route::post('/product/search', [FrontendController::class, 'productSearch'])->name('product.search');
/* =============== Advance Search ============= */
Route::get('search-product', [FrontendController::class, 'advanceProduct']);

/* =============== Hot Deals  ============= */
Route::get('/hot-deals', [FrontendController::class, 'hotDeals'])->name('hot_deals.all');


/* ===============  Category Wise Product Show  ============= */
Route::get('/category-product/{slug}',[FrontendController::class, 'CatWiseProduct'])->name('product.category');

/* ===============  Vendor Wise Product Show  ============= */
Route::get('/vendor-product/{slug}',[FrontendController::class, 'VendorWiseProduct'])->name('vendor.product');

/* ===============  Tag Wise Product Show  ============= */
Route::get('/tag-product/{id}/{slug}',[FrontendController::class, 'TagWiseProduct'])->name('product.tag');
/* =============== Product Details Show ============= */
Route::get('product-details/{id}/{slug?}', [FrontendController::class, 'productDetails'])->name('product.details');
/* =============== Product Review Store ============= */
Route::post('/review/store', [FrontendController::class, 'reviewStore'])->name('review.store');

// Page Setting

Route::get('/contact-us',[FrontendController::class, 'pageContact'])->name('page.contact');
Route::get('/about-us',[FrontendController::class, 'pageAbout'])->name('page.about');
Route::get('/blogs', [FrontendController::class, 'blog'])->name('blogs');
Route::get('/blogs/{slug}', [FrontendController::class, 'blogDetails'])->name('blogs.details');
Route::get('/terms-and-conditions',[FrontendController::class, 'pageTerms'])->name('page.terms');
Route::get('/privacy-policy',[FrontendController::class, 'pagePolicy'])->name('page.policy');
Route::get('/faq',[FrontendController::class, 'pageFaq'])->name('page.faq');
Route::get('/help',[FrontendController::class, 'pageHelp'])->name('page.help');
Route::get('/shipping&return',[FrontendController::class, 'shippingReturn'])->name('page.shipping-return');
Route::get('/session/login',[FrontendController::class, 'sessionlogindata'])->name('session.login.data');
Route::get('/affiliate',[FrontendController::class, 'affiliate'])->name('affiliate');
Route::get('/register/affiliate',[FrontendController::class, 'registerAffiliate'])->name('register.affiliate');
Route::get('/affiliate/password/request', [FrontendController::class, 'afiliatePasswordRequestForm'])->name('afiliate.password.request');
Route::post('/forgot-password-email', [FrontendController::class, 'sendOtp'])->name('affiliate.password.email');
Route::get('/affiliate/otp/verify-form', [FrontendController::class, 'afiliateOtpVerifyForm']);
Route::post('/verify-affiliate-otp', [FrontendController::class, 'verifyOtp'])->name('affiliate.otp.verify');
Route::get('/affiliate/reset-password/form', [FrontendController::class, 'affiliateResetPasswordForm']);
Route::post('/affiliate/reset-password', [FrontendController::class, 'resetPassword'])->name('affiliate.reset.password');

// Route::get('/page/{slug}',[FrontendController::class, 'pageAbout'])->name('page.about');

// Add this route near other static page routes
// Route::get('/price-stock-quality', function() {
//     return view('FrontEnd.page.price_stock_quality');
// })->name('price.stock.quality');

Route::post('/message/send',[UserMessageController::class, 'submit'])->name('message.submit');
Route::get('/ordertracking',[FrontendController::class, 'orderTracking'])->name('order.tracking');
Route::get('/order-track',[FrontendController::class, 'orderTrack'])->name('order.track');
// produce Warrenty history
Route::get('/product/warrenty',[FrontendController::class, 'productWarrenty'])->name('product.warrenty');
Route::get('/warranty/check',[FrontendController::class, 'warrantyCheck'])->name('warranty.check');
Route::get('/warranty/check',[FrontendController::class, 'warrantyCheck'])->name('warranty.check');
Route::get('/all/blogs',[FrontendController::class, 'allBlogs'])->name('all.blogs');
Route::get('/all/blogs')->name('all.blogs');

//order return request module
//Route::get('order/return/{invoice_no}/{slug}', [ReturnRequestController::class, 'index'])->name('order.return');
//Route::post('order/return/submit', [ReturnRequestController::class, 'submit'])->name('order.return.submit');
//Route::get('order/return/check/{id}', [ReturnRequestController::class, 'check'])->name('order.return.check');
//Route::get('get-product-by-id', [OrderController::class, 'getProductById'])->name('get-product-by-id');

Route::get('order/return/{invoice_no}/{slug}', [ReturningProductController::class, 'index'])->name('order.return');
Route::post('order/return/submit', [ReturningProductController::class, 'submit'])->name('order.return.submit');
Route::get('order/return/check', [ReturningProductController::class, 'check'])->name('order.return.check');


/* =============== Start Product View Modal With Ajax ============== */
Route::get('/product/view/modal/{id}',[FrontendController::class,'ProductViewAjax']);
/* ============ Start Add To Cart Store Data Withn Ajax  ============= */
Route::POST('/cart/data/store/{id}',[CartController::class, 'AddToCart'])->name('cart.add');
/* ============ Start Mini Cart With Ajax  ============= */
Route::get('/product/mini/cart',[CartController::class,'AddMiniCart'])->name('minicart.add');
Route::get('/minicart/product-remove/{rowId}',[CartController::class,'RemoveMiniCart'])->name('minicart.remove');
Route::get('/cart/check/{id}', [CartController::class, 'checkProductInCart']);
Route::get('/login-status/check', [FrontendController::class, 'loginCheck'])->name('login.check');

/* ============ Cart Show   ============= */
Route::get('/cart',[CartController::class,'index'])->name('cart.show');
/* ============ Cart Get Product   ============= */
Route::get('/get-cart-product', [CartController::class, 'getCartProduct'])->name('getcart.product');
/* ============  Cart Increment  ============= */
Route::get('/cart-increment/{rowId}', [CartController::class, 'cartIncrement'])->name('cart.decrement');
/* ============  Cart Decrement  ============= */
Route::get('/cart-decrement/{rowId}', [CartController::class, 'cartDecrement'])->name('cart.decrement');
/* ============ Cart Remove   ============= */
Route::get('/cart-remove/{rowId}', [CartController::class, 'removeCartProduct'])->name('cart.remove');
/* ============ All Cart Remove   ============= */
Route::get('/cart/all-delete',[CartController::class,'destroy'])->name('cart.remove.all');
/* ============  Cart Checkout   ============= */
Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');
Route::post('/checkout/payment',[CheckoutController::class,'payment'])->name('checkout.payment');
/* ============ Cart Checkout Product   ============= */
Route::get('/checkout-product', [CheckoutController::class, 'getCheckoutProduct'])->name('checktout.product');
/* ============  Checkout Store   ============= */
Route::post('/checkout/store',[CheckoutController::class,'store'])->name('checkout.store');
Route::get('/checkout/success/{id}',[CheckoutController::class,'show'])->name('checkout.success');

Route::get('/checkout/shipping/ajax/{shipping_cost}',[CheckoutController::class,'shippingAjax'])->name('checkout.shippingAjax');

/*================  Ajax  ==================*/
Route::get('/division-district/ajax/',[CheckoutController::class,'getdivision'])->name('division.ajax');
//Route::get('/division-district/ajax/{division_id}',[CheckoutController::class,'getdivision'])->name('division.ajax');
Route::get('/district-upazilla/ajax/',[CheckoutController::class,'getupazilla'])->name('upazilla.ajax');
/*================  Ajax  ==================*/

/* ============  All Product Show   ============= */
Route::get('/product/shop',[ProductController::class,'index'])->name('product.show');
/* =============== sort_by  ============= */

/* ============  All Product Show   ============= */
Route::get('/campaign/product',[ProductController::class,'campaignProducts'])->name('campaign.product');
/* =============== sort_by  ============= */

Route::get('/search', [ProductController::class, 'sort_by'])->name('sort_by.search');
// Attribute Data fetch
Route::get('/attribute-data',[AttributeController::class,'index'])->name('attribute.index');

//============ User Set Default Start ============//
Route::resource('/user', UserController::class);
Route::post('/user/profile/update', [UserController::class, 'userProfileUpdate'])->name('user.profile.update');
// User Dashboard
Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user-passwordupdate');
//=========== User Addresses all Route Start ============//
Route::post('/user/address/store', [UserController::class, 'store'])->name('user.address.store');
/*================  Ajax Brand Store ==================*/
Route::post('/address/store/',[UserController::class,'getAddressStore'])->name('address.ajax.store');

Route::get('user/addresses/delete/{id}', [UserController::class, 'address_destroy'])->name('user.addresses.destroy');
// Set_Default Show //
Route::get('/addresses/set_default/{id}', [UserController::class, 'set_default'])->name('addresses.set_default');
// Address Realtionship Division/District/Upazilla Show Data Ajax //
Route::get('/address/ajax/{address_id}',[UserController::class,'getAddress'])->name('address.ajax');
//=========== User Addresses all Route End ============//

Route::get('/varient-price/{id}/{varient}',[ProductController::class, 'getVarient'])->name('varient.price');

//============ User Set Default Start ============//

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

//Nagad
Route::get('/nagad/callback', [NagadController::class, 'verify'])->name('nagad.callback');

// bKash
Route::post('/bkash/createpayment', [BkashController::class, 'checkout'])->name('bkash.checkout');
Route::post('/bkash/executepayment', [BkashController::class, 'excecute'])->name('bkash.excecute');
Route::get('/bkash/success', [BkashController::class, 'success'])->name('bkash.success');
Route::get('/payment/error', [BkashController::class, 'error'])->name('bkash.error');

// sslcommerz
Route::get('/sslcommerz/pay', [PublicSslCommerzPaymentController::class, 'index']);
Route::POST('/sslcommerz/success', [PublicSslCommerzPaymentController::class, 'success']);
Route::POST('/sslcommerz/fail', [PublicSslCommerzPaymentController::class, 'fail']);
Route::POST('/sslcommerz/cancel', [PublicSslCommerzPaymentController::class, 'cancel']);
Route::POST('/sslcommerz/ipn', [PublicSslCommerzPaymentController::class, 'ipn']);

//aamarpay
Route::post('/aamarpay/success', [AamarpayController::class, 'success'])->name('aamarpay.success');
Route::post('/aamarpay/fail', [AamarpayController::class, 'fail'])->name('aamarpay.fail');

//Subscribers
Route::POST('/subscribers/store', [SubscriberController::class, 'store'])->name('subscribers.store');

// Compare
Route::post('/become-a-seller', [FrontendController::class, 'becomeaseller'])->name('become.a.seller');

Route::get('/compare', 'CompareController@index')->name('compare');
Route::get('/compare/reset', 'CompareController@reset')->name('compare.reset');
Route::post('/compare/addToCompare', 'CompareController@addToCompare')->name('compare.addToCompare');

Route::get('/contact',[ContactController::class, 'index'])->name('contact.index');
Route::post('/creat-contact',[ContactController::class, 'newcontact'])->name('new-contact');
Route::post('/apply-coupon',[FrontendController::class, 'applycoupon'])->name('apply-coupon');


Route::get('/load-more-products',[FrontendController::class, 'loadMoreProducts']);
//Route::get('/order/summary/download',[FrontendController::class, 'loadMoreProducts']);
// Route::post('/pages/store/{id}', [FrontendController::class, 'pagesstore'])->name('pages.store');

//order cancellation
Route::post('order/cancel', [OrderController::class, 'update_delivery_status'])->name('order.cancel.submit');


// ............


require __DIR__.'/auth.php';
