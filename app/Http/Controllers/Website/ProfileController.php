<?php

namespace App\Http\Controllers\Website;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profileSetting() {
        return view('website.include.user.setting');

    }


    public function passwordChange(Request $request) {
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
            return redirect('login')->with($message);
        }else {
            $message = array('message'=>'Old password not match','alert-type'=>'error' );
            return redirect()->back()->with($message);
        }

    }



    public function shippingStore(Request $request) {

        $shipping =Shipping::create([
            'user_id'          => auth::id(),
            'shipping_name'    => $request->name,
            'shipping_phone'   => $request->phone,
            'shipping_address' => $request->email,
            'shipping_country' => $request->address,
            'shipping_city'    => $request->country,
            'shipping_zipcode' => $request->city,
            'shipping_email'   => $request->zipcode
        ]);

        $message = array('message'=>'Shipping details Update','alert-type'=>'success' );
            return redirect()->back()->with($message);


    }



}
