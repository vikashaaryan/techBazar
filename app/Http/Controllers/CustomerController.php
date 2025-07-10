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
            'contact' => 'required|string|max:20|unique:customers,contact',
            'email' => 'required|email|max:255|unique:customers,email',
            'gender' => 'required|in:male,female',
            'status' => 'required|boolean',

            // Address
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
        ], [
            'email.unique' => 'The email address is already in use by another customer.',
            'contact.unique' => 'The contact number is already in use by another customer.'
        ]);

        $address = Address::create([
            'address' => $request->address,
            'addressable_type' => 'customer',
            'purpose' => 'billing',
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

        ToastMagic::success('Customer added successfully!');
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
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
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:customers,email,' . $customer->id,
            'gender' => 'required|in:male,female,other',
            'status' => 'required|boolean',

            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
        ], [
            'email.unique' => 'The email address is already in use by another customer.'
        ]);

        $customer->update([
            'name' => $request->name,
            'contact' => $request->contact,
            'email' => $request->email,
            'gender' => $request->gender,
            'status' => $request->status,
        ]);

        $addressData = [
            'address' => $request->address,
            'purpose' => $request->purpose ?? 'billing',
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'pincode' => $request->pincode,
        ];

        if ($customer->address) {
            $customer->address->update($addressData);
        } else {
            $customer->address()->create($addressData);
        }

        ToastMagic::success('Customer updated successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        ToastMagic::success('Customer deleted successfully!');
        return redirect()->back();
    }
}
