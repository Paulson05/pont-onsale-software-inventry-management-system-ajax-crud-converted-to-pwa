<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('backend.login');



})->name('loginpage');

Route::get('/qr-code-g', function () {

    \QrCode::size(500)
        ->format('png')
        ->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));

    return view('qrcode.index');

});



//product
Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/barcode', [ProductController::class, 'getProductCode'])->name('product.barcode');

Route::post('/post-product', [ProductController::class, 'store']);
Route::get('/fetch-product', [ProductController::class, 'fetchProduct']);
Route::get('/edit-product/{id}', [ ProductController::class, 'edit']);
Route::put('/update-product/{id}', [ProductController::class, 'update']);
Route::delete('/delete-product/{id}', [ProductController::class, 'destroy']);

//unit
Route::get('/unit', [UnitController::class, 'index'])->name('unit.index');
Route::post('/post-unit', [UnitController::class, 'store']);
Route::get('/fetch-unit', [UnitController::class, 'fetchUnit']);
Route::get('/edit-unit/{id}', [UnitController::class, 'edit']);
Route::put('/update-unit/{id}', [UnitController::class, 'update']);
Route::delete('/delete-unit/{id}', [UnitController::class, 'destroy']);

//category
Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
Route::post('/post-category', [CategoryController::class, 'store']);
Route::get('/fetch-category', [CategoryController::class, 'fetchCategory']);
Route::get('/edit-category/{id}', [CategoryController::class, 'edit']);
Route::put('/update-category/{id}', [CategoryController::class, 'update']);
Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);


//supplier
 Route::resource('/supplier',SupplierController::class)->except('create');

Route::post('/post-supplier', [SupplierController::class, 'store']);
Route::get('/fetchsupplier', [SupplierController::class, 'fetchsupplier']);
Route::get('/edit-supplier/{id}', [SupplierController::class, 'edit']);
Route::put('/update-product/{id}', [SupplierController::class, 'update']);
Route::delete('/delete-supplier/{id}', [SupplierController::class, 'destroy']);

//customer
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');

Route::post('/post-customer', [CustomerController::class, 'store']);
Route::get('/fetchcustomer', [CustomerController::class, 'fetchcustomer']);

Route::get('/edit-customer/{id}', [CustomerController::class, 'edit']);
Route::put('/update-customer/{id}', [CustomerController::class, 'update']);
Route::delete('/delete-customer/{id}', [CustomerController::class, 'destroy']);
Route::get('/customer-report', [CustomerController::class, 'customerReport'])->name('customer.report');
Route::get('/customer-report/pdf', [CustomerController::class, 'customerReportPdf'])->name('customer.report.pdf');
Route::get('/invoice/details/pdf/{invoice_id}', [CustomerController::class, 'invoiceDetailPdf'])->name('invoice.detail.pdf');

Route::get('/paid-customer', [CustomerController::class, 'paidCustomer'])->name('paid.customer');
Route::get('/paid-customer/pdf', [CustomerController::class, 'paidCustomerPdf'])->name('paid.customer.pdf');
Route::get('/customer-wise-report/', [CustomerController::class, 'customerWiseReport'])->name('customer.wise.report');
Route::get('/customer-wise-credit/pdf', [CustomerController::class, 'customerWiseCreditPdf'])->name('customer.wise.credit.pdf');
Route::get('/customer-wise-paid/pdf', [CustomerController::class, 'customerWisePaidPdf'])->name('customer.wise.paid.pdf');

//purchase


Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase.index');
Route::post('/post-purchase', [PurchaseController::class, 'store']);
Route::get('/fetchpurchase', [PurchaseController::class, 'fetchpurchase']);
Route::get('/edit-purchase/{id}', [PurchaseController::class, 'edit']);
Route::put('/update-purchase/{id}', [PurchaseController::class, 'update']);
Route::delete('/delete-purchase/{id}', [PurchaseController::class, 'destroy']);
Route::post('/store-purchase', [PurchaseController::class, 'store'])->name('purchase.store');
Route::get('/purchaselist', [PurchaseController::class, 'purchaseList'])->name('purchase-list');
Route::get('/pendinglist', [PurchaseController::class, 'pendingList'])->name('pending.list');
Route::get('/approved/purchase/{id}', [PurchaseController::class, 'approve'])->name('purchase.approve');
Route::get('/daily/purchase/report', [PurchaseController::class, 'dailyPurchaseReport'])->name('daily.purchase.report');
Route::get('/purchase/daily-report/pdf', [PurchaseController::class, 'DailyPurchasePdf'])->name('daily.purchase.report.pdf');

// invoice
Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
Route::get('/invoice/pending', [InvoiceController::class, 'invoiceList'])->name('invoice.list');
//Route::get('/invoiceapproval', [InvoiceController::class, 'pendingList'])->name('invoicepending.list');

Route::get('/get-stock', [DefaultController::class, 'getStock'])->name('check-product-stock');
Route::post('invoice/store',[InvoiceController::class, 'store'])->name('invoice.store');
Route::get('invoice/add',[InvoiceController::class, 'add'])->name('invoice.add');
Route::get('/approved/invoice/{id}', [InvoiceController::class, 'approve'])->name('invoice.approve');
Route::post('approval/store/{id}',[InvoiceController::class, 'approvelStore'])->name('approval.store');
Route::get('/print/list', [InvoiceController::class, 'printInvoiceList'])->name('invoice.print-list');
Route::get('/print/{id}', [InvoiceController::class, 'printInvoice'])->name('invoice.print');
Route::get('/invoice/daily', [InvoiceController::class, 'DailyInvoice'])->name('invoice.daily.report');
Route::get('/invoice/daily-report/pdf', [InvoiceController::class, 'DailyInvoicePdf'])->name('invoice.daily.report.pdf');


//stock

Route::get('/stock/report', [StockController::class, 'stockReport'])->name('stock.report');
Route::get('/stock/daily-report/pdf', [StockController::class, 'StockReportPdf'])->name('stock.report.pdf');
Route::get('/report/supplier/wise', [StockController::class, 'supplierWiseReport'])->name('supplier.wise.report');
Route::get('/report/supplier/wise/pdf', [StockController::class, 'supplierWiseReportPdf'])->name('supplier.wise.report.pdf');
Route::get('/report/product/wise/pdf', [StockController::class, 'productWiseReportPdf'])->name('product.wise.report.pdf');


// default
Route::get('/get-category', [DefaultController::class, 'getCategory'])->name('get-category');
Route::get('/get-product', [DefaultController::class, 'getProduct'])->name('get-product');

Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::post('/post-role', [RoleController::class, 'store']);
Route::post('/post-role2', [RoleController::class, 'mystore'])->name('mystore');
Route::get('/fetch-role', [RoleController::class, 'fetchRole']);
Route::get('/edit-role/{id}', [RoleController::class, 'edit']);
Route::put('/update-role/{id}', [RoleController::class, 'update']);
Route::delete('/delete-role/{id}', [RoleController::class, 'destroy']);


Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
Route::post('/post-permission', [PermissionController::class, 'store']);
Route::get('/fetch-permissiom', [PermissionController::class, 'fetchRole']);
Route::get('/edit-permission/{id}', [PermissionController::class, 'edit']);
Route::put('/update-permission/{id}', [PermissionController::class, 'update']);
Route::delete('/delete-permission/{id}', [PermissionController::class, 'destroy']);




Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/user-create', [AdminController::class, 'create'])->name('create');
Route::get('/logout', [AdminController::class, 'logOut'])->name('logOut');
Route::post('/postRegister', [AdminController::class, 'postRegister']);


Route::get('/fetchuser', [AdminController::class, 'fetchUser']);
Auth::routes();
