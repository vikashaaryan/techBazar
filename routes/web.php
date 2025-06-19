<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register', [HomeController::class, 'Usreregister'])->name('usreregister');
Route::post('/login', [HomeController::class, 'Userlogin'])->name('login.submit');
Route::post('/logout', [HomeController::class, 'Userlogout'])->name('Userlogout');


Route::get('/manager', [ManagerController::class, 'dashboard'])->name('manager.dashboard');


Route::resource('customer',CustomerController::class);
Route::resource('supplier',SupplierController::class);

Route::resource('category',CategoryController::class);
Route::resource('purchase',PurchaseController::class);

Route::get('/customers/{id}/info', [CustomerController::class, 'fetchInfo']);


// Custom AJAX routes
Route::get('/products/json', [ProductController::class, 'indexJson'])->name('products.json');
Route::get('/products/{product}/details', [ProductController::class, 'details'])->name('products.details');

// Resource route (standard CRUD)
Route::resource('product', ProductController::class);

// Route::resource('product',ProductController::class);
Route::resource('quotes', QuoteController::class);

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
