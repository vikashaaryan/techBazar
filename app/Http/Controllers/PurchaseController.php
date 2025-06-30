<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PurchaseController extends Controller
{
    /**
     * Display the purchase list page.
     */
    public function index(Request $request)
    {
        $query = Purchase::with('supplier')
            ->latest();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('id', 'like', "%{$request->search}%")
                    ->orWhereHas('supplier', function ($q) use ($request) {
                        $q->where('supplier_name', 'like', "%{$request->search}%");
                    });
            });
        }

        if ($request->status) {
            $query->where('payment_status', $request->status);
        }

        if ($request->from_date) {
            $query->where('purchase_date', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->where('purchase_date', '<=', $request->to_date);
        }

        $purchases = $query->paginate(15);

        return view('manager.purchase.manage-purchase', compact('purchases'));
    }

    /**
     * Show the form to create a new purchase.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('manager.purchase.insert-purchase', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created purchase in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_number' => 'required|string|unique:purchases,invoice_number',
            'amount' => 'required|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0|lte:amount',
            'payment_status' => 'required|in:paid,partial,due',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Start database transaction
        DB::beginTransaction();

        try {
            // Create the purchase
            $purchase = Purchase::create([
                'supplier_id' => $validated['supplier_id'],
                'invoice_number' => 'INV-' . $validated['invoice_number'],
                'amount' => $validated['amount'],
                'amount_paid' => $validated['amount_paid'],
                'payment_status' => $validated['payment_status'],
            ]);

            // Add purchase items
            foreach ($validated['items'] as $item) {
                $purchase->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['quantity'] * $item['price'],
                ]);
            }

            // Handle file attachment
            if ($request->hasFile('attachment')) {
                $path = $request->file('attachment')->store('purchase-attachments', 'public');
                $purchase->update(['attachment' => $path]);
            }

            DB::commit();

            return redirect()->route('purchase.index')
                ->with('success', 'Purchase created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error creating purchase: ' . $e->getMessage());
        }
    }
    public function show($id)
    {
        $purchase = Purchase::with(['supplier', 'items.product'])->findOrFail($id);

        // Get all purchases from the same supplier
        $supplierPurchases = Purchase::where('supplier_id', $purchase->supplier_id)
            ->where('id', '!=', $purchase->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get product purchase history for items in this purchase
        $productIds = $purchase->items->pluck('product_id');

        $productHistory = Product::whereIn('id', $productIds)
            ->withCount(['purchaseItems as times_purchased' => function ($query) {
                $query->select(DB::raw('count(distinct purchase_id)'));
            }])
            ->withSum('purchaseItems as total_quantity', 'quantity')
            ->with(['purchaseItems' => function ($query) {
                $query->orderBy('created_at', 'desc')->limit(1);
            }])
            ->get()
            ->map(function ($product) {
                $product->last_purchase_date = optional($product->purchaseItems->first())->created_at;
                $product->last_price = optional($product->purchaseItems->first())->price;
                return $product;
            });

        return view('manager.purchase.component.view-purchase', compact('purchase', 'supplierPurchases', 'productHistory'));
    }
    public function edit($id)
    {
        $purchase = Purchase::with('purchaseItems.product')->findOrFail($id);
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('manager.purchase.component.edit-purchase', compact('purchase', 'suppliers', 'products'));
    }
    public function update(Request $request, Purchase $purchase)
    {
        // Validate the request
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_number' => 'required|string|unique:purchases,invoice_number,' . $purchase->id,
            'amount' => 'required|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0|lte:amount',
            'payment_status' => 'required|in:paid,partial,due',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Start database transaction
        DB::beginTransaction();

        try {
            // Update the purchase
            $purchase->update([
                'supplier_id' => $validated['supplier_id'],
                'invoice_number' =>  $validated['invoice_number'],
                'amount' => $validated['amount'],
                'amount_paid' => $validated['amount_paid'],
                'payment_status' => $validated['payment_status'],
            ]);

            // Sync purchase items - first delete existing items
            $purchase->items()->delete();

            // Add new purchase items
            foreach ($validated['items'] as $item) {
                $purchase->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['quantity'] * $item['price'],
                ]);
            }

            // Handle file attachment
            if ($request->hasFile('attachment')) {
                // Delete old attachment if exists
                if ($purchase->attachment) {
                    Storage::disk('public')->delete($purchase->attachment);
                }

                $path = $request->file('attachment')->store('purchase-attachments', 'public');
                $purchase->update(['attachment' => $path]);
            }

            DB::commit();

            return redirect()->route('purchase.index')
                ->with('success', 'Purchase updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Error updating purchase: ' . $e->getMessage());
        }
    }
    public function destroy($id) {}
}
