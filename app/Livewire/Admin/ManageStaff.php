<?php

namespace App\Livewire\Admin;

use App\Models\Address;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Sales')]
class ManageStaff extends Component
{
    public $name, $email, $contact, $role = 'staff', $password;
    public $salary, $join_date, $status = 1, $user_id, $address_id;
    public $address, $city, $state, $pincode, $addressable_type = null, $purpose = null, $country = 'india';
    protected $rules = [
        'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
        'email' => 'required|email|unique:users,email',
        'contact' => 'required|string|max:10|min:10|unique:users,contact|regex:/^[6-9][0-9]{9}$/',
        'address' => 'required|string',
        'city' => 'required|string',
        'state' => 'required|string',
        'pincode' => 'required|digits_between:4,10',
        'salary' => 'required|numeric',
        'join_date' => 'required|date',
        'status' => 'nullable|in:0,1',
        'password' => 'required|string|min:6',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function addStaff()
    {
        $validated = $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'contact' => $this->contact,
            'role' => $this->role,
            'password' => Hash::make($this->password),
        ]);

        $address = Address::create([
            'address' => $this->address,
            'addressable_type' => 'customer',
            'purpose' => 'billing',
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'pincode' => $this->pincode,
        ]);

        Staff::create([
            'user_id' => $user->id,
            'address_id' => $address->id,
            'salary' => $this->salary,
            'join_date' => $this->join_date,
            'status' => $this->status,
        ]);

        $this->redirect('/allStaff', navigate:true);

    }
    public function render()
    {
        return view('livewire.admin.manage-staff')->layout('components.layouts.admin');
    }
}
