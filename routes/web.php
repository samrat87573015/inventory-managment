<?php

use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokanVarifictionMiddleware;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    return view('welcome');
});


Route::post('/userRegistration', [UserController::class, 'userRegistration'])->name('userRegistration');
Route::post('/userLogin', [UserController::class, 'userLogin'])->name('userLogin');
Route::post('/sendOtp', [UserController::class, 'sendOtp'])->name('sendOtp');
Route::post('/verifyOtp', [UserController::class, 'varifyOtp'])->name('verifyOtp');
Route::post('/resetPassword', [UserController::class, 'resetPassword'])->name('resetPassword')->middleware([TokanVarifictionMiddleware::class]);


Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware([TokanVarifictionMiddleware::class]);


Route::get('/getUserProfile', [UserController::class, 'getUserProfile'])->name('getUserProfile')->middleware([TokanVarifictionMiddleware::class]);

Route::post('/updateUserProfile', [UserController::class, 'updateUserProfile'])->name('updateUserProfile')->middleware([TokanVarifictionMiddleware::class]);


//page routes
Route::get('/register', [UserController::class, 'register'])->name('registerPage');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/send-otp', [UserController::class, 'sendOtpPage'])->name('sendOtpPage');
Route::get('/varify-otp', [UserController::class, 'varifyOtpPage'])->name('varifyOtpPage');
Route::get('/reset-password', [UserController::class, 'resetPasswordPage'])->name('resetPasswordPage')->middleware([TokanVarifictionMiddleware::class]);
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware([TokanVarifictionMiddleware::class]);

Route::get('/user-profile', [UserController::class, 'userProfile'])->name('userProfile')->middleware([TokanVarifictionMiddleware::class]);

Route::get('/dashboardHeaderInfo', [DashboardController::class, 'dashboardHeaderInfo'])->name('dashboardHeaderInfo')->middleware([TokanVarifictionMiddleware::class]);




//category routes
Route::post('/create-category', [CategoryController::class, 'createCategory'])->name('createCategory')->middleware([TokanVarifictionMiddleware::class]);

Route::post('/update-category', [CategoryController::class, 'updateCategory'])->name('updateCategory')->middleware([TokanVarifictionMiddleware::class]);

Route::post('/delete-category', [CategoryController::class, 'deleteCategory'])->name('deleteCategory')->middleware([TokanVarifictionMiddleware::class]);

Route::get('/getCategoryList', [CategoryController::class, 'getCategoryList'])->name('getCategoryList')->middleware([TokanVarifictionMiddleware::class]);

Route::get('/category', [CategoryController::class, 'categoryPage'])->name('categoryPage')->middleware([TokanVarifictionMiddleware::class]);

Route::post('/getCategoryID', [CategoryController::class, 'getCategoryID'])->name('getCategoryID')->middleware([TokanVarifictionMiddleware::class]);




//customer routes
Route::post('/create-customer', [CustomerController::class, 'createCustomer'])->name('createCustomer')->middleware([TokanVarifictionMiddleware::class]);
Route::post('/update-customer', [CustomerController::class, 'updateCustomer'])->name('updateCustomer')->middleware([TokanVarifictionMiddleware::class]);
Route::post('/delete-customer', [CustomerController::class, 'deleteCustomer'])->name('deleteCustomer')->middleware([TokanVarifictionMiddleware::class]);

Route::post('/getCustomerID', [CustomerController::class, 'getCustomerID'])->name('getCustomerID')->middleware([TokanVarifictionMiddleware::class]);

Route::get('/getCustomerList', [CustomerController::class, 'getCustomerList'])->name('getCustomerList')->middleware([TokanVarifictionMiddleware::class]);

Route::get('/customers', [CustomerController::class, 'customerPage'])->name('customerPage')->middleware([TokanVarifictionMiddleware::class]);



// product routes

Route::post('/create-product', [ProductController::class, 'createProduct'])->name('createProduct')->middleware([TokanVarifictionMiddleware::class]);

Route::post('/update-product', [ProductController::class, 'updateProduct'])->name('updateProduct')->middleware([TokanVarifictionMiddleware::class]);

Route::post('/delete-product', [ProductController::class, 'deleteProduct'])->name('deleteProduct')->middleware([TokanVarifictionMiddleware::class]);

Route::post('/getProductByID', [ProductController::class, 'getProductByID'])->name('getProductByID')->middleware([TokanVarifictionMiddleware::class]);

Route::get('/getProductList', [ProductController::class, 'getProductList'])->name('getProductList')->middleware([TokanVarifictionMiddleware::class]);

Route::get('/products', [ProductController::class, 'productPage'])->name('productPage')->middleware([TokanVarifictionMiddleware::class]);




// Invoice routes

Route::post('/create-invoice', [InvoiceController::class, 'createInvoice'])->name('createInvoice')->middleware([TokanVarifictionMiddleware::class]);

Route::post('/delete-invoice', [InvoiceController::class, 'deleteInvoice'])->name('deleteInvoice')->middleware([TokanVarifictionMiddleware::class]);

Route::get('/invoiceSeleted', [InvoiceController::class, 'invoiceSeleted'])->name('invoiceSeleted')->middleware([TokanVarifictionMiddleware::class]);

Route::post('/invoiceDetails', [InvoiceController::class, 'invoiceDetails'])->name('invoiceDetails')->middleware([TokanVarifictionMiddleware::class]);

Route::get('/create-sale', [InvoiceController::class, 'createSalePage'])->name('createSalePage')->middleware([TokanVarifictionMiddleware::class]);

Route::get('/invoice', [InvoiceController::class, 'invoicePage'])->name('invoicePage')->middleware([TokanVarifictionMiddleware::class]);




//Report routes

Route::get('/sale-report', [ReportController::class, 'saleReport'])->name('saleReport')->middleware([TokanVarifictionMiddleware::class]);

Route::get('/ganaratSale/{fromDate}/{toDate}', [ReportController::class, 'ganaratSaleReport'])->name('ganaratSaleReport')->middleware([TokanVarifictionMiddleware::class]);




