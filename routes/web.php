<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SupplierController;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Sales;
use App\Livewire\CreateQuotation;
use App\Livewire\Exchange\Exchange;
use App\Livewire\Exchange\ViewExchange;
use App\Livewire\Invoice\CreateInvoice;
use App\Livewire\Invoice\EditInvoice;
use App\Livewire\Invoice\ShowInvoice;
use App\Livewire\Quotation;
use App\Livewire\Quote;
use App\Livewire\ShowQuotation;
use App\Models\Invoice;
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

Route::resource('product', ProductController::class);

// livewire admin
Route::get('/admin', Dashboard::class)->name('admin.dashboard');
Route::get('/admin/sales', Sales::class)->name('admin.sales');

// quotation by livewire
Route::get('/quotation/create', CreateQuotation::class)->name('createQuotation');
Route::get('/quotations', ShowQuotation::class)->name('showQuotation');

//Invoice Route By Livewire
Route::get('/invoice/create', CreateInvoice::class)->name('createInvoice');
Route::get('/invoices', ShowInvoice::class)->name('showInvoice');


Route::get('/view-exchange', ViewExchange::class)->name('exchange.view');
Route::get('/create-exchange', Exchange::class)->name('exchange.create');

Route::get('/invoices/{invoice}/edit', function (Invoice $invoice) {
    return app()->call(EditInvoice::class, [
        'invoice' => $invoice->load(['customer', 'sales'])
    ]);
})->name('invoices.edit');
//genrate pdf useing dom pdf

Route::get('/generate-pdf/{id}', [PdfController::class, 'genratePdf'])->name('generate.pdf');