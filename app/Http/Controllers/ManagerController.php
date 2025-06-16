<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    
    public function dashboard()
    {
        return view('manager.dashboard');
    }
   
}
