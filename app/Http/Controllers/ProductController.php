<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view("manager.products.manage-products", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('manager.products.insertProduct', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'category' => 'required|exists:categories,id',
            'mrp' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0|lte:mrp',
            'qty' => 'required|integer|min:0',
            'brand' => 'required|string|max:100',
            'barcode' => 'nullable|string|max:100|unique:products,barcode',
            'warranty' => 'nullable|string|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string|max:1000',
        ]);

        $data['image'] = request()->file('image')->store('product_images', 'public');

        Product::create($data);
        ToastMagic::success('Product added successfully!');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('manager.products.component.edit-product', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'category' => 'required|exists:categories,id',
            'mrp' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0|lte:mrp',
            'qty' => 'required|integer|min:0',
            'brand' => 'required|string|max:100',
            'barcode' => 'nullable|string|max:100|unique:products,barcode,' . $product->id,
            'warranty' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string|max:1000',
        ]);

        // Handle image update if new image is provided
        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($product->image);
            // Store new image
            $data['image'] = request()->file('image')->store('product_images', 'public');
        } else {
            // Keep the existing image if no new image is uploaded
            $data['image'] = $product->image;
        }

        $product->update($data);
        ToastMagic::success('Product updated successfully!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete the associated image
        Storage::disk('public')->delete($product->image);

        $product->delete();
        ToastMagic::success('Product deleted successfully!');
        return redirect()->back();
    }

    public function indexJson()
    {
        // Send minimal data for dropdowns
        return Product::select('id', 'name')->get();
    }

    public function details(Product $product)
    {
        return response()->json([
            'description' => $product->description,
            'mrp' => $product->mrp,
            'sell_price' => $product->sell_price,
            'discount' => $product->mrp - $product->sell_price
        ]);
    }
}
