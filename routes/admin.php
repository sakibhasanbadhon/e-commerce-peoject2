<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Auth::routes();



Route::get('admin/login', [LoginController::class, 'adminLogin'])->name('admin.login');

Route::get('admin/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard')->middleware('is_admin');

Route::get('/admin',function(){
    return view('layouts.admin');
});
