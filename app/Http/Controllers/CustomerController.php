<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('manager.customer.managecustomer', compact('customers'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.customer.addcustomer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            //customer
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'gender' => 'required|in:male,female',
            'status' => 'required|boolean',

            // Address

            'address' => 'required|string|max:500',
            'addressable_type' => 'required|in:customer,supplier',
            'purpose' => 'required|in:billing,shipping',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
        ]);

        $address = Address::create([
            'address' => $request->address,
            'addressable_type' => $request->addressable_type,
            'purpose' => $request->purpose,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pincode' => $request->pincode
        ]);

        Customer::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'email' => $request->email,
            'gender' => $request->gender,
            'status' => $request->status,
            'address_id' => $address->id,
        ]);
        ToastMagic::success('Customer Add successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->back();}
}
