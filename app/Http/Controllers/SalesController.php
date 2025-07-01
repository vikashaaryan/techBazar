<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function create(Request $request)
    {
        $query = Sales::with('customer')
            ->latest();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('invoice_number', 'like', "%{$request->search}%")
                    ->orWhereHas('customer', function ($q) use ($request) {
                        $q->where('name', 'like', "%{$request->search}%");
                    });
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->from_date) {
            $query->where('sale_date', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->where('sale_date', '<=', $request->to_date);
        }

        $sales = $query->paginate(15);

        return view('manager.sales.sale-manage', compact('sales'));
    }

    public function index(Request $request)
    {
        // Get filter parameters
        $timePeriod = $request->input('time_period', 'all');
        $customerId = $request->input('customer_id');
        $productId = $request->input('product_id');
        $paymentStatus = $request->input('payment_status');
        $invoiceStatus = $request->input('invoice_status');
        $search = $request->input('search');
        $sort = $request->input('sort', 'sales.created_at');
        $direction = $request->input('direction', 'desc');

        // Start building the query
        $sales = Sales::with(['customer', 'invoice', 'items.product', 'payments'])
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->join('invoices', 'sales.invoice_id', '=', 'invoices.id')
            ->when($timePeriod, function ($query) use ($timePeriod) {
                if ($timePeriod === 'today') {
                    return $query->whereDate('sales.created_at', today());
                } elseif ($timePeriod === 'week') {
                    return $query->whereBetween('sales.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                } elseif ($timePeriod === 'month') {
                    return $query->whereMonth('sales.created_at', now()->month);
                } elseif ($timePeriod === 'year') {
                    return $query->whereYear('sales.created_at', now()->year);
                }
            })
            ->when($customerId, function ($query) use ($customerId) {
                return $query->where('sales.customer_id', $customerId);
            })
            ->when($productId, function ($query) use ($productId) {
                return $query->whereHas('items', function ($q) use ($productId) {
                    $q->where('product_id', $productId);
                });
            })
            ->when($paymentStatus, function ($query) use ($paymentStatus) {
                return $query->where('sales.payment_status', $paymentStatus);
            })
            ->when($invoiceStatus, function ($query) use ($invoiceStatus) {
                return $query->where('invoices.status', $invoiceStatus);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('invoices.invoice_no', 'like', "%$search%")
                        ->orWhere('customers.name', 'like', "%$search%")
                        ;
                });
            })
            ->select('sales.*')
            ->orderBy($sort, $direction)
            ->paginate(15);

        // Calculate summary stats
        $totalSales = Sales::sum('total_amount');
        $monthlySales = Sales::whereMonth('created_at', now()->month)->sum('total_amount');
        $averageSaleValue = Sales::avg('total_amount') ?? 0;

        // Get payment totals
        $totalPaid = Payment::where('status', 'captured')->sum('amount_paid');
        $totalDue = Sales::where('payment_status', '!=', 'paid')->sum(DB::raw('total_amount - amount_paid'));

        // Get top selling product
        // Only select the columns you need and include them in GROUP BY
        $topProduct = Product::select('products.id', 'products.name')
            ->selectRaw('SUM(sales_items.qty) as total_quantity')
            ->join('sales_items', 'products.id', '=', 'sales_items.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_quantity')
            ->first();
        // Get customers and products for filters
        $customers = Customer::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('manager.sales.sale-history', compact(
            'sales',
            'totalSales',
            'monthlySales',
            'averageSaleValue',
            'totalPaid',
            'totalDue',
            'topProduct',
            'customers',
            'products'
        ));
    }

    public function show(Sales $sale)
    {
        // Get customer's other purchases (excluding current one)
        $customerPurchases = Sales::where('customer_id', $sale->customer_id)
            ->where('id', '!=', $sale->id)
            ->with(['invoice', 'items'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get product purchase history for items in this sale
        $productIds = $sale->items->pluck('product_id');

        $productHistory = Product::whereIn('id', $productIds)
            ->withCount(['items as times_purchased' => function ($query) use ($sale) {
                $query->whereHas('sale', function ($q) use ($sale) {
                    $q->where('customer_id', $sale->customer_id);
                });
            }])
            ->withSum(['items as total_quantity' => function ($query) use ($sale) {
                $query->whereHas('sale', function ($q) use ($sale) {
                    $q->where('customer_id', $sale->customer_id);
                });
            }], 'qty')
            ->with(['items' => function ($query) use ($sale) {
                $query->whereHas('sale', function ($q) use ($sale) {
                    $q->where('customer_id', $sale->customer_id)
                        ->orderBy('created_at', 'desc');
                })->limit(1);
            }])
            ->get()
            ->map(function ($product) {
                $product->last_purchase_date = optional($product->items->first())->created_at;
                $product->last_price = optional($product->items->first())->price;
                return $product;
            });

        return view('manager.sales.components.show-sales', compact('sale', 'customerPurchases', 'productHistory'));
    }

    public function printInvoice(Sales $sale)
    {
        $sale->load(['customer', 'invoice', 'items.product']);
        // Generate PDF invoice using a package like dompdf
        // return view('manager.sales-history.invoice', compact('sale'));
    }

    public function export(Request $request)
    {
        // Implement export functionality (Excel, CSV, etc.)
    }
}

