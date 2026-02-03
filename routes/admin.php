<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AccountsController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CampaingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\DisplaySizeController;
use App\Http\Controllers\Backend\DisplayTypeController;
use App\Http\Controllers\Backend\GenerationController;
use App\Http\Controllers\Backend\RAMController;
use App\Http\Controllers\Backend\HDDController;
use App\Http\Controllers\Backend\SSDController;
use App\Http\Controllers\Backend\GraphicsController;
use App\Http\Controllers\Backend\OperatingSystemController;
use App\Http\Controllers\Backend\SpecialFeatureController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\ProcessorTypeController;
use App\Http\Controllers\Backend\ProcessorModelController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductInvoiceController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SmsController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Backend\SubscriberController;
use App\Http\Controllers\Backend\SupplierController;
//use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorPaymentController;
use App\Http\Controllers\Backend\VendorTransactionController;
use App\Http\Controllers\Backend\WithdrawRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserMessageController;
use App\Http\Controllers\Frontend\ReturnRequestController;
use App\Http\Controllers\ReturningProductController;
use App\Http\Controllers\OrderCancellationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::get('/admin-login', [AdminController::class, 'Index'])->name('login_form');
Route::post('/admin-submit', [AdminController::class, 'Login'])->name('admin.login');

Route::get('/affiliate/login', [AdminController::class, 'Index'])->name('vendor.login_form');

/*========================== Only Vendor Accessible Route  ==========================*/
Route::prefix('affiliate')->middleware('vendor')->group(function () {
    //Withdraw Request All Routes
    Route::resource('/withdraw-requests', WithdrawRequestController::class);
    Route::post('/withdraw-requests/update/{id}', [WithdrawRequestController::class, 'update'])->name('withdraw-requests.update');
    Route::get('/withdraw-requests/remove/{id}', [WithdrawRequestController::class, 'delete'])->name('withdraw-requests.delete');
});
/*==========================End Only Vendor Accessible Route  ==========================*/

//*========================== Common Accessible All Routes  ==========================*/
//dd(Auth::guard('admin')->check());
if (Auth::guard('admin')->check()) {
    if (Auth::guard('admin')->user()->role == 1) {
        $prefix = 'admin';
    } else {
        $prefix = 'affiliate';
        /// dd('vv');
    }
} else {
    //dd('hgf');
    $prefix = 'admin';
}
Route::prefix($prefix)->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'AminLogout'])->name('admin.logout');
    Route::get('/register', [AdminController::class, 'AdminRegister'])->name('admin.regester');
    Route::post('/register/store', [AdminController::class, 'AdminRegisterStore'])->name('admin.register.store');
    Route::get('/forgot-password', [AdminController::class, 'AdminForgotPassword'])->name('admin.password.request');
    Route::get('/profile', [AdminController::class, 'Profile'])->name('admin.profile');
    Route::get('/edit/profile', [AdminController::class, 'EditProfile'])->name('edit.profile');
    Route::post('/store/profile', [AdminController::class, 'StoreProfile'])->name('store.profile');
    Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');
    Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update.password');

    /* ================ Admin Cache Clear ============== */
    Route::get('/cache-cache', [AdminController::class, 'clearCache'])->name('cache.clear');

    //Withdraw Request Routes
    Route::get('/withdraw-requests', [WithdrawRequestController::class, 'index'])->name('withdraw-requests.index');

    // Admin Brand All Routes
    Route::prefix('supplier')->group(function () {
        Route::get('/view', [SupplierController::class, 'SupplierView'])->name('supplier.all');
        Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('/create', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::get('/delete/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
        Route::get('/supplier_active/{id}', [SupplierController::class, 'active'])->name('supplier.active');
        Route::get('/supplier_inactive/{id}', [SupplierController::class, 'inactive'])->name('supplier.in_active');
    });

    // Admin Tags All Routes
    Route::prefix('tag')->group(function () {
        Route::get('/view', [TagController::class, 'TagView'])->name('tag.all');
        Route::get('/add', [TagController::class, 'TagAdd'])->name('tag.add');
        Route::post('/store', [TagController::class, 'TagStore'])->name('tag.store');
        Route::get('/edit/{id}', [TagController::class, 'TagEdit'])->name('tag.edit');
        Route::post('/update/{id}', [TagController::class, 'TagUpdate'])->name('tag.update');
        Route::get('/delete/{id}', [TagController::class, 'TagDelete'])->name('tag.delete');
        Route::get('/tag_active/{id}', [TagController::class, 'active'])->name('tag.active');
        Route::get('/tag_inactive/{id}', [TagController::class, 'inactive'])->name('tag.in_active');
    });

    // Admin Product All Routes
    Route::prefix('product')->group(function () {
        Route::get('/view', [ProductController::class, 'ProductView'])->name('product.all');
        Route::get('/add', [ProductController::class, 'ProductAdd'])->name('product.add');
        Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
        Route::get('/storage/products', [ProductController::class, 'storageProducts'])->name('storage.products');


        Route::post('/update/{id}', [ProductController::class, 'ProductUpdate'])->name('product.update');

        Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');

        Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');

        Route::get('/product_active/{id}', [ProductController::class, 'active'])->name('product.active');
        Route::get('/product_inactive/{id}', [ProductController::class, 'inactive'])->name('product.in_active');

        Route::get('/product_featured/{id}', [ProductController::class, 'featured'])->name('product.featured');

        // Add Attribute Add
        Route::post('/add-more-choice-option', [ProductController::class, 'add_more_choice_option'])->name('products.add-more-choice-option');

        // ajax product page //
        Route::get('/category/subcategory/ajax/{category_id}', [ProductController::class, 'GetSubProductCategory']);
        Route::get('/subcategory/minicategory/ajax/{subcategory_id}', [ProductController::class, 'GetSubSubCategory']);
    });

     Route::prefix('invoice')->group(function () {
        // off line Orders All Route
        Route::get('/product/all/invoices', [ProductInvoiceController::class, 'allInvoice'])->name('product.all.invoice');
        Route::get('/product/invoice/create', [ProductInvoiceController::class, 'invoiceCreate'])->name('product.invoice.create');
        Route::get('/customers/{id}', [ProductInvoiceController::class, 'getCustomer'])->name('customers.get');
        Route::get('/get-product-details/{id}', [ProductInvoiceController::class, 'getProductDetails'])->name('products.details');
        Route::post('/product/invoice/store', [ProductInvoiceController::class, 'invoiceStore'])->name('product.invoice.store');
        Route::get('/unexisting-product/invoice/create', [ProductInvoiceController::class, 'unexistingProductInvoiceCreate'])->name('create.invoice.unexciting.product');
        Route::post('/unexisting-product/invoice/store', [ProductInvoiceController::class, 'unexistingProductInvoiceStore'])->name('store.unexciting.product.invoice');
        Route::get('/product/invoice/show/{invoice_no}', [ProductInvoiceController::class, 'productInvoiceShow'])->name('product.invoice.show');
        Route::get('/product/invoice/dwonload/{invoice_no}', [ProductInvoiceController::class, 'generateInvoicePdf'])->name('product.invoice.download');
        Route::get('/product/invoice/edit/{invoice_no}', [ProductInvoiceController::class, 'productInvoiceEdit'])->name('product.invoice.edit');
        Route::post('/product/invoice/update/{invoice_no}', [ProductInvoiceController::class, 'productInvoiceUpdate'])->name('product.invoice.update');
        Route::get('/product/invoice/delete/{invoice_no}', [ProductInvoiceController::class, 'productInvoiceDelete'])->name('product.invoice.delete');
        Route::get('/product/invoice/return/', [ProductInvoiceController::class, 'productInvoiceReturn'])->name('product.return.invoice');
        Route::post('/product/invoice/return/store/', [ProductInvoiceController::class, 'productInvoiceReturnStore'])->name('product.return.invoice.store');
        Route::get('/product/invoice/return/list/', [ProductInvoiceController::class, 'productInvoiceReturnList'])->name('product.return.list');
    });

    //Vendor Transactions All Routes
    Route::get('/transaction/list', [VendorTransactionController::class, 'index'])->name('transaction.index');
    Route::get('/account/summary', [VendorTransactionController::class, 'transactionSummary'])->name('transaction.summary');
    Route::get('/account/details/{id}', [VendorTransactionController::class, 'details'])->name('transaction.details');

    // Report All Route
    Route::get('/stock_report', [ReportController::class, 'index'])->name('stock_report.index');
    Route::get('/sales-report', [ReportController::class, 'salesReport'])->name('sales.report');
    Route::get('/sales-report/details/{id}', [ReportController::class, 'details'])->name('report.view');

    /*================  Ajax Category Store ==================*/
    Route::post('/category/insert', [ProductController::class, 'categoryInsert'])->name('category.ajax.store');
    /*================  Ajax Brand Store ==================*/
    Route::post('/brand/insert', [ProductController::class, 'brandInsert'])->name('brand.ajax.store');

    Route::get('/get-total-regular-price', function () {
        return session('totalRegularPrice');
    });

    Route::get('/forget-total-regular-price', function () {
        session()->forget('totalRegularPrice');
    });
    Route::get('/get-total-buying-price', function () {
        return session('totalBuyingPrice');
    });

    Route::get('/forget-total-buying-price', function () {
        session()->forget('totalBuyingPrice');
    });

    Route::get('return-request/all', [ReturningProductController::class, 'list'])->name('return-request.all');
    Route::get('return-request/show/{id}', [ReturnRequestController::class, 'show'])->name('return-request.show');
});


//*========================== End Common Accessible All Routes  ==========================*/


//*========================== Only Admin Accessible All Routes  ==========================*/
Route::middleware('adminAccess')->group(function () {

    // ==================== Admin Brand All Routes ===================//
    Route::prefix('brand')->group(function () {
        Route::get('/view', [BrandController::class, 'BrandView'])->name('brand.all');
        Route::get('/add', [BrandController::class, 'BrandAdd'])->name('brand.add');
        Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
        Route::post('/update/{id}', [BrandController::class, 'BrandUpdate'])->name('brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
        Route::get('/brand_active/{id}', [BrandController::class, 'active'])->name('brand.active');
        Route::get('/brand_inactive/{id}', [BrandController::class, 'inactive'])->name('brand.in_active');
    });

    // Admin Category All Routes
    Route::prefix('category')->group(function () {

        Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::get('/check-category-tabs', [CategoryController::class, 'checkCategoryTabs'])->name('check-category-tabs');

        Route::get('/category_active/{id}', [CategoryController::class, 'active'])->name('category.active');
        Route::get('/category_inactive/{id}', [CategoryController::class, 'inactive'])->name('category.in_active');

        Route::get('/category_feature_status_change/{id}', [CategoryController::class, 'changeFeatureStatus'])->name('category.changeFeatureStatus');
    });

    // ==================== Admin Processor Type All Routes ===================//
    Route::prefix('processor')->group(function () {
        Route::get('/view', [ProcessorTypeController::class, 'ProcessorView'])->name('processor.all');
        Route::get('/add', [ProcessorTypeController::class, 'ProcessorAdd'])->name('processor.add');
        Route::post('/store', [ProcessorTypeController::class, 'ProcessorStore'])->name('processor.store');
        Route::get('/edit/{id}', [ProcessorTypeController::class, 'ProcessorEdit'])->name('processor.edit');
        Route::post('/update/{id}', [ProcessorTypeController::class, 'ProcessorUpdate'])->name('processor.update');
        Route::get('/delete/{id}', [ProcessorTypeController::class, 'ProcessorDelete'])->name('processor.delete');
        Route::get('/processor_active/{id}', [ProcessorTypeController::class, 'active'])->name('processor.active');
        Route::get('/processor_inactive/{id}', [ProcessorTypeController::class, 'inactive'])->name('processor.in_active');
    });

    // ==================== Admin Processor Model All Routes ===================//
    Route::prefix('processor-model')->group(function () {
        Route::get('/view', [ProcessorModelController::class, 'ProcessorModelView'])->name('processor.model.all');
        Route::get('/add', [ProcessorModelController::class, 'ProcessorModelAdd'])->name('processor.model.add');
        Route::post('/store', [ProcessorModelController::class, 'ProcessorModelStore'])->name('processor.model.store');
        Route::get('/edit/{id}', [ProcessorModelController::class, 'ProcessorModelEdit'])->name('processor.model.edit');
        Route::post('/update/{id}', [ProcessorModelController::class, 'ProcessorModelUpdate'])->name('processor.model.update');
        Route::get('/delete/{id}', [ProcessorModelController::class, 'ProcessorModelDelete'])->name('processor.model.delete');
        Route::get('/processor-model-active/{id}', [ProcessorModelController::class, 'active'])->name('processor.model.active');
        Route::get('/processor-modle-inactive/{id}', [ProcessorModelController::class, 'inactive'])->name('processor.model.in_active');
    });

    // ==================== Admin Generation All Routes ===================//
    Route::prefix('generation')->group(function () {
        Route::get('/view', [GenerationController::class, 'GenerationView'])->name('generation.all');
        Route::get('/add', [GenerationController::class, 'GenerationAdd'])->name('generation.add');
        Route::post('/store', [GenerationController::class, 'GenerationStore'])->name('generation.store');
        Route::get('/edit/{id}', [GenerationController::class, 'GenerationEdit'])->name('generation.edit');
        Route::post('/update/{id}', [GenerationController::class, 'GenerationUpdate'])->name('generation.update');
        Route::get('/delete/{id}', [GenerationController::class, 'GenerationDelete'])->name('generation.delete');
        Route::get('/generation-active/{id}', [GenerationController::class, 'active'])->name('generation.active');
        Route::get('/generation-inactive/{id}', [GenerationController::class, 'inactive'])->name('generation.in_active');
    });

    // ==================== Admin DisplaySize All Routes ===================//
    Route::prefix('display-size')->group(function () {
        Route::get('/view', [DisplaySizeController::class, 'DisplaySizeView'])->name('display.size.all');
        Route::get('/add', [DisplaySizeController::class, 'DisplaySizeAdd'])->name('display.size.add');
        Route::post('/store', [DisplaySizeController::class, 'DisplaySizeStore'])->name('display.size.store');
        Route::get('/edit/{id}', [DisplaySizeController::class, 'DisplaySizeEdit'])->name('display.size.edit');
        Route::post('/update/{id}', [DisplaySizeController::class, 'DisplaySizeUpdate'])->name('display.size.update');
        Route::get('/delete/{id}', [DisplaySizeController::class, 'DisplaySizeDelete'])->name('display.size.delete');
        Route::get('/displaysize-active/{id}', [DisplaySizeController::class, 'active'])->name('display.size.active');
        Route::get('/displaysize-inactive/{id}', [DisplaySizeController::class, 'inactive'])->name('display.size.in_active');
    });

    // ==================== Admin DisplayType All Routes ===================//
    Route::prefix('display-type')->group(function () {
        Route::get('/view', [DisplayTypeController::class, 'DisplayTypeView'])->name('display.type.all');
        Route::get('/add', [DisplayTypeController::class, 'DisplayTypeAdd'])->name('display.type.add');
        Route::post('/store', [DisplayTypeController::class, 'DisplayTypeStore'])->name('display.type.store');
        Route::get('/edit/{id}', [DisplayTypeController::class, 'DisplayTypeEdit'])->name('display.type.edit');
        Route::post('/update/{id}', [DisplayTypeController::class, 'DisplayTypeUpdate'])->name('display.type.update');
        Route::get('/delete/{id}', [DisplayTypeController::class, 'DisplayTypeDelete'])->name('display.type.delete');
        Route::get('/displaytype-active/{id}', [DisplayTypeController::class, 'active'])->name('display.type.active');
        Route::get('/displaytype-inactive/{id}', [DisplayTypeController::class, 'inactive'])->name('display.type.in_active');
    });

    // ==================== Admin RAM All Routes ===================//
    Route::prefix('ram-size')->group(function () {
        Route::get('/view', [RAMController::class, 'RamSizeView'])->name('ram.size.all');
        Route::get('/add', [RAMController::class, 'RamSizeAdd'])->name('ram.size.add');
        Route::post('/store', [RAMController::class, 'RamSizeStore'])->name('ram.size.store');
        Route::get('/edit/{id}', [RAMController::class, 'RamSizeEdit'])->name('ram.size.edit');
        Route::post('/update/{id}', [RAMController::class, 'RamSizeUpdate'])->name('ram.size.update');
        Route::get('/delete/{id}', [RAMController::class, 'RamSizeDelete'])->name('ram.size.delete');
        Route::get('/ramsize-active/{id}', [RAMController::class, 'RamSizeActive'])->name('ram.size.active');
        Route::get('/ramsize-inactive/{id}', [RAMController::class, 'RamSizeInactive'])->name('ram.size.in_active');
    });
    Route::prefix('ram-type')->group(function () {
        Route::get('/view', [RAMController::class, 'RamTypeView'])->name('ram.type.all');
        Route::get('/add', [RAMController::class, 'RamTypeAdd'])->name('ram.type.add');
        Route::post('/store', [RAMController::class, 'RamTypeStore'])->name('ram.type.store');
        Route::get('/edit/{id}', [RAMController::class, 'RamTypeEdit'])->name('ram.type.edit');
        Route::post('/update/{id}', [RAMController::class, 'RamTypeUpdate'])->name('ram.type.update');
        Route::get('/delete/{id}', [RAMController::class, 'RamTypeDelete'])->name('ram.type.delete');
        Route::get('/ramtype-active/{id}', [RAMController::class, 'RamTypeActive'])->name('ram.type.active');
        Route::get('/ramtype-inactive/{id}', [RAMController::class, 'RamTypeInactive'])->name('ram.type.in_active');
    });

    // ==================== Admin HDD-SSD All Routes ===================//
    Route::prefix('hdd')->group(function () {
        Route::get('/view', [HDDController::class, 'HDDView'])->name('hdd.all');
        Route::get('/add', [HDDController::class, 'HDDAdd'])->name('hdd.add');
        Route::post('/store', [HDDController::class, 'HDDStore'])->name('hdd.store');
        Route::get('/edit/{id}', [HDDController::class, 'HDDEdit'])->name('hdd.edit');
        Route::post('/update/{id}', [HDDController::class, 'HDDUpdate'])->name('hdd.update');
        Route::get('/delete/{id}', [HDDController::class, 'HDDDelete'])->name('hdd.delete');
        Route::get('/hdd-active/{id}', [HDDController::class, 'HDDActive'])->name('hdd.active');
        Route::get('/hdd-inactive/{id}', [HDDController::class, 'HDDInactive'])->name('hdd.in_active');
    });
    Route::prefix('ssd')->group(function () {
        Route::get('/view', [SSDController::class, 'SSDView'])->name('ssd.all');
        Route::get('/add', [SSDController::class, 'SSDAdd'])->name('ssd.add');
        Route::post('/store', [SSDController::class, 'SSDStore'])->name('ssd.store');
        Route::get('/edit/{id}', [SSDController::class, 'SSDEdit'])->name('ssd.edit');
        Route::post('/update/{id}', [SSDController::class, 'SSDUpdate'])->name('ssd.update');
        Route::get('/delete/{id}', [SSDController::class, 'SSDDelete'])->name('ssd.delete');
        Route::get('/ssd-active/{id}', [SSDController::class, 'SSDActive'])->name('ssd.active');
        Route::get('/ssd-inactive/{id}', [SSDController::class, 'SSDInactive'])->name('ssd.in_active');
    });

    // ==================== Admin Graphics All Routes ===================//
    Route::prefix('graphics')->group(function () {
        Route::get('/view', [GraphicsController::class, 'GraphicsView'])->name('graphics.all');
        Route::get('/add', [GraphicsController::class, 'GraphicsAdd'])->name('graphics.add');
        Route::post('/store', [GraphicsController::class, 'GraphicsStore'])->name('graphics.store');
        Route::get('/edit/{id}', [GraphicsController::class, 'GraphicsEdit'])->name('graphics.edit');
        Route::post('/update/{id}', [GraphicsController::class, 'GraphicsUpdate'])->name('graphics.update');
        Route::get('/delete/{id}', [GraphicsController::class, 'GraphicsDelete'])->name('graphics.delete');
        Route::get('/graphics-active/{id}', [GraphicsController::class, 'GraphicsActive'])->name('graphics.active');
        Route::get('/graphics-inactive/{id}', [GraphicsController::class, 'GraphicsInactive'])->name('graphics.in_active');
    });

    // ==================== Admin OperationgSystem All Routes ===================//
    Route::prefix('operating-system')->group(function () {
        Route::get('/view', [OperatingSystemController::class, 'OperatingSystemView'])->name('operating.system.all');
        Route::get('/add', [OperatingSystemController::class, 'OperatingSystemAdd'])->name('operating.system.add');
        Route::post('/store', [OperatingSystemController::class, 'OperatingSystemStore'])->name('operating.system.store');
        Route::get('/edit/{id}', [OperatingSystemController::class, 'OperatingSystemEdit'])->name('operating.system.edit');
        Route::post('/update/{id}', [OperatingSystemController::class, 'OperatingSystemUpdate'])->name('operating.system.update');
        Route::get('/delete/{id}', [OperatingSystemController::class, 'OperatingSystemDelete'])->name('operating.system.delete');
        Route::get('/operating-system-active/{id}', [OperatingSystemController::class, 'OperatingSystemActive'])->name('operating.system.active');
        Route::get('/operating-system-inactive/{id}', [OperatingSystemController::class, 'OperatingSystemInactive'])->name('operating.system.in_active');
    });

    // ==================== Admin SpecialFeature All Routes ===================//
    Route::prefix('special-feature')->group(function () {
        Route::get('/view', [SpecialFeatureController::class, 'SpecialFeatureView'])->name('special.feature.all');
        Route::get('/add', [SpecialFeatureController::class, 'SpecialFeatureAdd'])->name('special.feature.add');
        Route::post('/store', [SpecialFeatureController::class, 'SpecialFeatureStore'])->name('special.feature.store');
        Route::get('/edit/{id}', [SpecialFeatureController::class, 'SpecialFeatureEdit'])->name('special.feature.edit');
        Route::post('/update/{id}', [SpecialFeatureController::class, 'SpecialFeatureUpdate'])->name('special.feature.update');
        Route::get('/delete/{id}', [SpecialFeatureController::class, 'SpecialFeatureDelete'])->name('special.feature.delete');
        Route::get('/special-feature-active/{id}', [SpecialFeatureController::class, 'SpecialFeatureActive'])->name('special.feature.active');
        Route::get('/special-feature-inactive/{id}', [SpecialFeatureController::class, 'SpecialFeatureInactive'])->name('special.feature.in_active');
    });


    // Attribute All Route
    Route::resource('/attribute', AttributeController::class);
    Route::get('/attribute/delete/{id}', [AttributeController::class, 'destroy'])->name('attribute.delete');
    // AttributeValue All Route
    Route::post('/attribute/value', [AttributeController::class, 'value_store'])->name('attribute.value_store');
    Route::get('/attribute/value/edit/{id}', [AttributeController::class, 'value_edit'])->name('attribute_value.edit');
    Route::post('/attribute/value/update/{id}', [AttributeController::class, 'value_update'])->name('attribute.val_update');
    Route::get('/attribute_value_active/{id}', [AttributeController::class, 'value_active'])->name('attribute_value.active');
    Route::get('/attribute_value_inactive/{id}', [AttributeController::class, 'value_inactive'])->name('attribute_value.in_active');
    Route::get('/attribute/value/delete/{id}', [AttributeController::class, 'value_destroy'])->name('attribute_value.delete');

    // Admin Slider All Routes
    Route::resource('/slider', SliderController::class);
    Route::get('/slider/delete/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
    Route::get('/slider_active/{id}', [SliderController::class, 'active'])->name('slider.active');
    Route::get('/slider_inactive/{id}', [SliderController::class, 'inactive'])->name('slider.in_active');

    // Admin Vendor All Routes
    Route::resource('/vendor', VendorController::class);
    Route::get('/affiliate/sell/request', [VendorController::class, 'vendorrequest'])->name('vendor.sell.request');
    Route::get('/vendor/delete/{id}', [VendorController::class, 'destroy'])->name('vendor.delete');
    Route::get('/vendor/password.update/{id}', [VendorController::class, 'passwordUpdate'])->name('vendor.password.update');
    Route::post('/vendor/password.update/{id}', [VendorController::class, 'passwordUpdateStore'])->name('vendor.password.update.store');
    Route::get('/affiliate_active/{id}', [VendorController::class, 'active'])->name('vendor.active');
    Route::get('/affiliate_inactive/{id}', [VendorController::class, 'inactive'])->name('vendor.in_active');

    Route::get('/active/all', [VendorController::class, 'activeAll'])->name('active.all');


    Route::get('/affiliate/product', [VendorController::class, 'affiliateProduct'])->name('affiliate.product');


    Route::get('/withdraw-requests/approve/{id}', [VendorPaymentController::class, 'addPaymentForRequest'])->name('request.approve');

    //Vendor Payment All Routes
    Route::resource('/payment', VendorPaymentController::class);
    Route::post('/payment/store', [VendorPaymentController::class, 'store'])->name('payment.store');
    Route::post('/payment/update/{id}', [VendorPaymentController::class, 'update'])->name('payment.update');



    // Admin Customer All Routes
    Route::resource('/customer', UserController::class);

    //Admin Campaign All Route
    Route::resource('/campaing', CampaingController::class);
    Route::get('/campaing/delete/{id}', [CampaingController::class, 'destroy'])->name('campaing.delete');
    Route::get('/campaing_active/{id}', [CampaingController::class, 'active'])->name('campaing.active');
    Route::get('/campaing_inactive/{id}', [CampaingController::class, 'inactive'])->name('campaing.in_active');

    Route::post('/flash_deals/product_discount', [CampaingController::class, 'product_discount'])->name('flash_deals.product_discount');
    Route::post('/prodcts/product_discount', [CampaingController::class, 'prodcts'])->name('prodcts.product_discount');
    Route::post('/flash-deals/product-discount-edit', [CampaingController::class, 'product_discount_edit'])->name('flash_deals.product_discount_edit');


    //------------------------- Group Product-------------------------
    Route::post('/group_product/product_discount', [CampaingController::class, 'group_product_discount'])->name('group_product.product_discount');
    Route::post('/group-product/product-discount-edit', [CampaingController::class, 'group_product_discount_edit'])->name('group_product.product_discount_edit');
    //------------------------- End Group Product-------------------------



    // <--------- Banner route start ------>
    Route::resource('/banner', BannerController::class);
    Route::post('/banner/update/{id}', [BannerController::class, 'update'])->name('banner.update');
    Route::get('/banner/delete/{id}', [BannerController::class, 'destroy'])->name('banner.delete');
    Route::get('/banner_active/{id}', [BannerController::class, 'active'])->name('banner.active');
    Route::get('/banner_inactive/{id}', [BannerController::class, 'inactive'])->name('banner.in_active');

    // <--------- Blog route start ------>
    Route::resource('/blog', BlogController::class);
    Route::post('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
    Route::get('/blog_active/{id}', [BlogController::class, 'active'])->name('blog.active');
    Route::get('/blog_inactive/{id}', [BlogController::class, 'inactive'])->name('blog.in_active');

    // <--------- Page route start ------>
    Route::resource('/page', PageController::class);
    Route::post('/page/update/{id}', [PageController::class, 'update'])->name('page.update');
    Route::get('/page/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');
    Route::get('/page_active/{id}', [PageController::class, 'active'])->name('page.active');
    Route::get('/page_inactive/{id}', [PageController::class, 'inactive'])->name('page.in_active');



    //Unit All Route
    Route::get('/unit', [AttributeController::class, 'index_unit'])->name('unit.index');
    Route::get('/unit/create', [AttributeController::class, 'create_unit'])->name('unit.create');
    Route::post('/unit/store', [AttributeController::class, 'store_unit'])->name('unit.store');
    Route::get('/unit/edit/{id}', [AttributeController::class, 'edit_unit'])->name('unit.edit');
    Route::post('/unit/update/{id}', [AttributeController::class, 'update_unit'])->name('unit.update');
    Route::get('/unit/delete/{id}', [AttributeController::class, 'destroy_unit'])->name('unit.delete');
    Route::get('/unit-status/{id}', [AttributeController::class, 'changeStatus'])->name('unit.changeStatus');


    // Setting All Route
    Route::get('/settings/index', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/settings/update', [SettingController::class, 'update'])->name('update.setting');
    Route::get('/settings/activation', [SettingController::class, 'activation'])->name('setting.activation');

    // Shipping Methods Route
    Route::get('/shipping/index', [ShippingController::class, 'index'])->name('shipping.index');
    Route::get('/shipping/create', [ShippingController::class, 'create'])->name('shipping.create');
    Route::post('/shipping/store', [ShippingController::class, 'store'])->name('shipping.store');
    Route::get('/shipping/edit/{id}', [ShippingController::class, 'edit'])->name('shipping.edit');
    Route::post('/shipping/update/{id}', [ShippingController::class, 'update'])->name('shipping.update');
    Route::get('/shipping/delete/{id}', [ShippingController::class, 'destroy'])->name('shipping.delete');
    Route::get('/shipping_active/{id}', [ShippingController::class, 'active'])->name('shipping.active');
    Route::get('/shipping_inactive/{id}', [ShippingController::class, 'inactive'])->name('shipping.in_active');

    Route::get('/attributes/combination', [AttributeController::class, 'combination'])->name('combination.index');

    // Payment Methods Route
    Route::get('/payment-methods/configuration', [PaymentMethodController::class, 'index'])->name('paymentMethod.config');
    Route::post('/payment-methods/update', [PaymentMethodController::class, 'update'])->name('paymentMethod.update');


    Route::prefix('orders')->group(function () {
        // Orders All Route
        Route::get('/orders', [OrderController::class, 'allOrders'])->name('all_orders.index');
        Route::get('/orders/online', [OrderController::class, 'index'])->name('all_orders.online');
        Route::get('/orders/offline', [OrderController::class, 'index2'])->name('all_orders.offline');
        Route::get('/orders/installment', [OrderController::class, 'installmentOrders'])->name('order.installment');
        Route::get('/all_orders/{id}/show', [OrderController::class, 'show'])->name('all_orders.show');
        Route::get('/installment_orders/{id}/show', [OrderController::class, 'installment_show'])->name('installment_orders.show');


        Route::get('/orders_delete/{id}', [OrderController::class, 'destroy'])->name('delete.orders');
        Route::post('/orders_update/{id}', [OrderController::class, 'update'])->name('admin.orders.update');
        Route::post('/installment_update/{id}', [OrderController::class, 'installmentupdate'])->name('admin.installment.update');
        Route::get('/invoice/{id}', [OrderController::class, 'invoice_download'])->name('invoice.download');
    });

     // product serial number update
    Route::post('/orders/update-serial-number', [OrderController::class, 'updateSerialNumber'])
        ->name('orders.update_serial_number');
    // payment status
    Route::post('/orders/update_payment_status', [OrderController::class, 'update_payment_status'])->name('orders.update_payment_status');
    // delivery status
    Route::post('/orders/update_delivery_status', [OrderController::class, 'update_delivery_status'])->name('orders.update_delivery_status');




    /*================  Admin Address Updated  ==================*/
    Route::post('/address/update/{id}', [OrderController::class, 'admin_address_update'])->name('admin.address.update');
    /*================  Admin User Updated  ==================*/
    Route::post('/user/update/{id}', [OrderController::class, 'admin_user_update'])->name('admin.user.update');
    /*================  Ajax  ==================*/
    Route::get('/division-district/ajax/{division_id}', [OrderController::class, 'getdivision'])->name('division.ajax');
    Route::get('/district-upazilla/ajax/{district_id}', [OrderController::class, 'getupazilla'])->name('upazilla.ajax');
    /*================  Ajax  ==================*/



    // <--------- Coupon route start ------>
    Route::resource('/coupons', CouponController::class);
    Route::post('/coupon/update/{id}', [CouponController::class, 'update'])->name('coupons.update');
    Route::get('/coupon/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.delete');
    Route::get('/coupon_active/{id}', [CouponController::class, 'active'])->name('coupon.active');
    Route::get('/coupon_inactive/{id}', [CouponController::class, 'inactive'])->name('coupon.in_active');

    // sms-templates //
    Route::get('/sms-templates', [SmsController::class, 'template_index'])->name('sms.templates');
    Route::post('/sms-templates/store', [SmsController::class, 'store'])->name('sms.templates.store');
    Route::post('/sms-templates/update/{template_id}', [SmsController::class, 'template_update'])->name('sms.templates.update');

    // sms-providers //
    Route::get('/sms-providers', [SmsController::class, 'provider_index'])->name('sms.providers');
    Route::post('/sms-providers/store', [SmsController::class, 'providersStore'])->name('sms.providers.store');
    Route::post('/sms-providers/update/{provider_id}', [SmsController::class, 'provider_update'])->name('sms.providers.update');

    // role premissions //
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // role premissions staffs //
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
    Route::post('/staff/update/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::get('/staff/delete/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

    //Subscribers
    Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
    Route::get('/subscribers/destroy/{id}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');

    // Admin Accounting All Routes
    Route::prefix('accounts')->group(function () {
        Route::get('/account-heads', [AccountsController::class, 'heads'])->name('accounts.heads');
        Route::get('/account-heads/create', [AccountsController::class, 'create_head'])->name('accounts.heads.create');
        Route::post('/account-heads/store', [AccountsController::class, 'store_head'])->name('accounts.heads.store');
        Route::get('/account-heads/change-status/{id}', [AccountsController::class, 'change_status_head'])->name('accounts.heads.change_status');
        Route::get('/account-heads/delete/{id}', [AccountsController::class, 'head_destroy'])->name('accounts.heads.delete');
        Route::get('/account-ledgers', [AccountsController::class, 'ledgers'])->name('accounts.ledgers');
        Route::get('/account-ledgers/create', [AccountsController::class, 'create_ledger'])->name('accounts.ledgers.create');
        Route::post('/account-ledgers/store', [AccountsController::class, 'store_ledger'])->name('accounts.ledgers.store');
        Route::get('/account-ledgers/delete/{id}', [AccountsController::class, 'ledger_destroy'])->name('accounts.ledgers.delete');
    });

    Route::post('/pos/customer/insert', [PosController::class, 'customerInsert'])->name('customer.ajax.store.pos');


    //Admin POS All Routes
    Route::prefix('pos')->group(function () {
        Route::get('/', [PosController::class, 'index'])->name('pos.index');
        Route::get('/product', [PosController::class, 'getProduct'])->name('pos.getProduct');
        Route::get('/product/variants', [PosController::class, 'getProductVariations'])->name('pos.getProductVariations');
        Route::get('/variant-product', [PosController::class, 'getVariantProduct'])->name('pos.getVariantProduct');
        Route::get('/get-products', [PosController::class, 'filter'])->name('pos.filter');
        Route::POST('/store', [PosController::class, 'store'])->name('pos.store');
    });

    //user-message routes
    Route::get('/messages', [UserMessageController::class, 'list'])->name('messages.list');

    //return request update
    Route::post('return-request/update', [ReturningProductController::class, 'update'])->name('return-request.update');

    //order cancellation request
    Route::get('order/cancellation/requests', [OrderController::class, 'cancellationRequest'])->name('order.cancellation.requests');
});

//*==========================End Only Admin Accessible All Routes  ==========================*/





/*========================== End Admin Route  ==========================*/

require __DIR__ . '/auth.php';
