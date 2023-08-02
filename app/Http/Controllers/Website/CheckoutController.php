<?php

namespace App\Http\Controllers\Website;

use App\Models\Coupon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
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
                        'main_balance' => Cart::subtotal()-$coupon_check->coupon_amount,
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

    // orderPlace
    public function orderPlace(Request $request) {
        $data =[
            'user_id'         => auth::id(),
            'order_id'        => rand(10000,900000),
            'c_name'          => $request->c_name,
            'c_phone'         => $request->c_phone,
            'c_address'       => $request->c_address,
            'c_email'         => $request->c_email,
            'c_country'       => $request->c_country,
            'c_city'          => $request->c_city,
            'c_zipcode'       => $request->c_zipcode,
            'payment_type'    => $request->payment_type,
            'tax'             => 0,
            'shipping_charge' => 0,
            'status'          => 0,
        ];

        if (Session::has('coupon')) {
            $data['subtotal']        = Cart::subtotal();
            $data['total']           = Cart::total();
            $data['coupon_code']     = Session::get('coupon')['name'];
            $data['coupon_discount'] = Session::get('coupon')['discount'];
            $data['main_balance']    = Session::get('coupon')['main_balance'];
            $data['tax']             = 0;
            $data['shipping_charge'] = 0;
            $data['status']          = 0;
        }else{
            $data['subtotal'] = Cart::subtotal();
            $data['total']    = Cart::total();
        }

        $order_id = Order::create($data)->id;

        Mail::to($request->c_email)->send(new InvoiceMail($data));



        // order details

        $content = Cart::content();

        $details = array();
        foreach($content as $row){
            $details['order_id']=$order_id;
            $details['product_id']=$row->id;
            $details['product_name']=$row->name;
            $details['color']=$row->options->color;
            $details['size']=$row->options->size;
            $details['quantity']=$row->qty;
            $details['single_price']=$row->price;
            $details['subtotal_price']=$row->price*$row->qty;
            OrderDetail::create($details);
        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $message = array('message'=>'Order Successful','alert-type'=>'success');
        return redirect()->back()->with($message);

    }












}
