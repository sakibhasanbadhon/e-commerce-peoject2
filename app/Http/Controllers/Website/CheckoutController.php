<?php

namespace App\Http\Controllers\Website;

use App\Models\Coupon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout() {
        if (!Auth::check()) {
            $message = array('message'=>'At first login your account','alert-type'=>'error');
            return redirect()->back()->with($message);
        }
        // $session = Session::all();
        // dd($session);
        // Session::flash('coupon');
        $contents = Cart::content();
        $category = Category::get();
        return view('website.cart.checkout',compact('contents','category'));

    }


    public function applyCoupon(Request $request) {
            $coupon_check = Coupon::where('coupon_code',$request->coupon)->first();
            if ($coupon_check) {
                if(date('Y-m-d', strtotime(date('Y-m-d')))<= date('Y-m-d', strtotime($coupon_check->valid_date))){
                    session::put('coupon',[
                        'name' => $coupon_check->coupon_code,
                        'discount' => $coupon_check->coupon_amount,
                        'mail_balance' => Cart::subtotal()-$coupon_check->coupon_amount,
                    ]);

                    $message = array('message'=>'Coupon Applied!','alert-type'=>'success');
                    return redirect()->back()->with($message);

                }else{
                    $message = array('message'=>'Coupon Code is Expired','alert-type'=>'error');
                    return redirect()->back()->with($message);

                }

            }else{
                $message = array('message'=>'coupon Code Not Match','alert-type'=>'error');
                return redirect()->back()->with($message);
            }
    }


    // coupon remove

    public function removeCoupon() {
        Session::forget('coupon');
        $message = array('message'=>'coupon Removed','alert-type'=>'success');
        return redirect()->back()->with($message);

    }
}
