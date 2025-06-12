<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register', [HomeController::class, 'Usreregister'])->name('usreregister');
Route::post('/login', [HomeController::class, 'Userlogin'])->name('login.submit');
Route::post('/logout', [HomeController::class, 'Userlogout'])->name('Userlogout');


Route::get('/staff', [StaffController::class, 'index'])->name('staff.dashboard');
Route::get('/staff/Addcustomer/',[StaffController::class,'Addcustomer'])->name('Addcustomer');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
