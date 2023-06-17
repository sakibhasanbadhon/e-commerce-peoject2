<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function admin()
    {
        return view('admin.dashboard');
    }

    /**
     * admin Logout
     */

    public function adminLogout()
    {
        Auth::logout();
        $message = array('message'=>'You are Logged out','alert-type'=>'success' );
        return redirect()->route('admin.login')->with($message);
    }

    public function passwordChange() {

    }



}
