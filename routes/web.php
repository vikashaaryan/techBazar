<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SupplierController;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\DueAlert;
use App\Livewire\Admin\ManageSales;
use App\Livewire\Admin\ManageStaff;
use App\Livewire\Admin\SaleHistory;
use App\Livewire\Admin\TopProduct;
use App\Livewire\CreateQuotation;
use App\Livewire\Exchange\EditExchange;
use App\Livewire\Exchange\ExchangeDetail;
use App\Livewire\Exchange\ExchangeForm;
use App\Livewire\Exchange\ViewExchange;
use App\Livewire\Invoice\CreateInvoice;
use App\Livewire\Invoice\EditInvoice;
use App\Livewire\Invoice\ShowInvoice;
use App\Livewire\Manager\Profile;
use App\Livewire\Quotation\EditQuotation;
use App\Livewire\ShowQuotation;
use App\Models\Invoice;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes (Public)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'home'])->name('login');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register', [HomeController::class, 'Usreregister'])->name('usreregister');
Route::post('/login', [HomeController::class, 'Userlogin'])->name('login.submit');
Route::get('/logout', [HomeController::class, 'Userlogout'])->name('Userlogout');

/*
|--------------------------------------------------------------------------
| Manager Routes (Staff & Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:staff|admin'])->group(function () {
    // Dashboard
    Route::get('/manager', [ManagerController::class, 'dashboard'])->name('manager.dashboard');

    // Resource Routes
    Route::resources([
        'customer' => CustomerController::class,
        'supplier' => SupplierController::class,
        'category' => CategoryController::class,
        'purchase' => PurchaseController::class,
        'product' => ProductController::class,
    ]);

    // Customer Specific
    Route::get('/customers/{id}/info', [CustomerController::class, 'fetchInfo']);

    // Quotation Routes (Livewire)
    Route::prefix('quotations')->group(function () {
        Route::get('/create', CreateQuotation::class)->name('createQuotation');
        Route::get('/', ShowQuotation::class)->name('showQuotation');
        Route::get('/edit/{quotation}', EditQuotation::class)->name('editQuotation');
    });

    // Invoice Routes (Livewire)
    Route::prefix('invoices')->group(function () {
        Route::get('/create', CreateInvoice::class)->name('createInvoice');
        Route::get('/', ShowInvoice::class)->name('showInvoice');
        Route::get('/{invoice}/edit', function (Invoice $invoice) {
            return app()->call(EditInvoice::class, [
                'invoice' => $invoice->load(['customer', 'sales'])
            ]);
        })->name('invoices.edit');
    });

    // Exchange Routes (Livewire)
    Route::prefix('exchange')->group(function () {
        Route::get('/', ViewExchange::class)->name('exchange.view');
        Route::get('/create', ExchangeForm::class)->name('exchange.create');
        Route::get('/{exchange}/edit', EditExchange::class)->name('exchange.edit');
        Route::get('/{exchange}/detail', ExchangeDetail::class)->name('exchange.detail');
    });

    // PDF Routes
    Route::prefix('pdf')->group(function () {
        Route::post('/invoices/{id}/send-email', [PdfController::class, 'SendEmail'])
            ->name('invoices.send-email');
        Route::get('/generate/{id}', [PdfController::class, 'genratePdf'])->name('generate.pdf');
        Route::get('/download/{id}', [PdfController::class, 'downloadPdf'])->name('downloadPdf');
    });

    // Payment Routes
    Route::prefix('payments')->group(function () {
        Route::get('/enter-payment', [PaymentController::class, 'enterpayment'])->name('enter.payment');
        Route::post('/enter-payment', [PaymentController::class, 'storePayment'])->name('manager.payments.store');
        Route::get('/records', [PaymentController::class, 'records'])->name('payments.records');
    });

    // Sales Routes
    Route::prefix('sales')->group(function () {
        Route::get('/', [SalesController::class, 'create'])->name('manage.sales');
        Route::get('/history', [SalesController::class, 'index'])->name('sales.history');
        Route::get('/history/{sale}', [SalesController::class, 'show'])->name('manager.sales-history.show');
        Route::get('/history/{sale}/print', [SalesController::class, 'printInvoice'])->name('manager.sales-history.print');
        Route::get('/history/export', [SalesController::class, 'export'])->name('manager.sales-history.export');
    });

    // Profile
    Route::get('manager/profile', Profile::class)->name('manager.setting');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard & Analytics
    Route::get('/', Dashboard::class)->name('admin.dashboard');
    Route::get('/sales', ManageSales::class)->name('admin.sales');
    Route::get('/top-products', TopProduct::class)->name('admin.top-product');
    Route::get('/due-alerts', DueAlert::class)->name('admin.due-alert');
    Route::get('/sale-history', SaleHistory::class)->name('admin.sale-history');

    // Staff Management
    Route::get('/staff', ManageStaff::class)->name('admin.staff');
});
