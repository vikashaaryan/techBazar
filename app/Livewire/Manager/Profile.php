<?php

namespace App\Livewire\Manager;

use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        $manager = Staff::where('user_id', Auth::id())->with('address')->first();
        return view('livewire.manager.profile', compact('manager'));
    }
}
