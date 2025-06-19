<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    /**
     * Display the purchase list page.
     */
    public function index()
    {
       $purchases = Purchase::all();
        return view('manager.purchase.manage-purchase',compact('purchases'));
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
}
