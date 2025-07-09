<?php

namespace App\Livewire\Manager;

use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangeManagerPassword extends Component
{
     public $old_password;
    public $new_password;
    public $showForm = false;

   

    public function updatePassword()
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($this->old_password, $user->password)) {
            $this->addError('old_password', 'The old password is incorrect.');
            return;
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        ToastMagic::success('Password changed successfully.');

        // Reset form
        $this->reset(['old_password', 'new_password', 'showForm']);
    }

    public function render()
    {
        return view('livewire.manager.change-manager-password');
    }
}
