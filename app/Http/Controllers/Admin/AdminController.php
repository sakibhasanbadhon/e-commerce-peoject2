<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        return redirect()->route('login')->with($message);
    }

    public function passwordChange() {
        return view('admin.auth.password_change');
    }

    public function passwordUpdate(Request $request){

        // dd($request->all());

        $validation = $request->validate([
            'old_password' => 'required',
            'password'     => 'required|confirmed',
            // 'password_confirmation' => 'required'

        ]);

        $authPassword = auth::user();
        if (Hash::check($request->old_password, $authPassword->password)) {
            $authId = User::findOrFail($authPassword->id);
            // $authId->password = Hash::make($request->password);
            // $authId->save();
            $authId->update([
                'password'=> Hash::make($request->password)
            ]);
            Auth::logout();
            $message = array('message'=>'You are Logged out','alert-type'=>'success' );
            return redirect()->route('admin.login')->with($message);
        }else {
            $message = array('message'=>'Old password not match','alert-type'=>'error' );
            return redirect()->back()->with($message);
        }




    }

    



}
