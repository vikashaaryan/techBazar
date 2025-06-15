@extends('manager.managerlayout')

@section('title', 'Manage Product')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="flex justify-between items-center">
            <h3 class="font-semibold text-xl">manage Products (5)</h3>
            <a href="{{ route('product.create') }}" class="bg-teal-500 font-semibold rounded px-2 py-1">Add New Product</a>
        </div>
        <table class="mt-5 w-full">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Sku</th>
                    <th>category</th>
                    <th>unit</th>
                    <th>price</th>
                    <th>Quantity</th>
                    <th>brand</th>
                    <th>barcode</th>
                    <th>Warranty Period</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
