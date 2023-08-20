<?php

namespace App\Http\Controllers\Website;

use App\Models\Coupon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment_gateway;
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
        if ($request->payment_type=="Hand Cash") {

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

        }elseif ($request->payment_type=="aamarpay") {
            $amarpay= Payment_gateway::first();
            if ($amarpay->store_id==null) {
                $message = array('message'=>'Please setting your payment gateway','alert-type'=>'error');
                return redirect()->back()->with($message);
            } else {
                if ($amarpay->status==1) {
                    $url = "https://secure.aamarpay.com/jsonpost.php"; // for Live
                } else {
                    $url = "https://​sandbox​.aamarpay.com/jsonpost.php";
                }

                $tran_id = "test".rand(1111111,9999999);//unique transection id for every transection
                $currency= "BDT"; //aamarPay support Two type of currency USD & BDT
                $amount = Cart::total();   //10 taka is the minimum amount for show card option in aamarPay payment gateway
                $store_id = $amarpay->store_id;
                $signature_key = $amarpay->signature_key;
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "store_id": "'.$store_id.'",
                    "tran_id": "'.$tran_id.'",
                    "success_url": "'.route('success').'",
                    "fail_url": "'.route('fail').'",
                    "cancel_url": "'.route('cancel').'",
                    "amount": "'.$amount.'",
                    "currency": "'.$currency.'",
                    "signature_key": "'.$signature_key.'",
                    "desc": "Payment Description",
                    "cus_name": "'.$request->c_name.'",
                    "cus_email": "'.$request->c_email.'",
                    "cus_add1": "'.$request->c_address.'",
                    "cus_add2": "Mirpur 10",
                    "cus_city": "'.$request->c_city.'",
                    "cus_state": "Dhaka",
                    "cus_postcode": "'.$request->c_zipcode.'",
                    "cus_country": "'.$request->c_country.'",
                    "cus_phone": "'.$request->c_phone.'",
                    "type": "json",
                    "opt_a": "'.$request->c_country.'",
                    "opt_b": "'.$request->c_city.'",
                    "opt_c": "'.$request->c_address.'",
                    "opt_d": "'.$request->payment_type.'"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                // dd($response);

                $responseObj = json_decode($response);

                if(isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {

                    $paymentUrl = $responseObj->payment_url;
                    // dd($paymentUrl);
                    return redirect()->away($paymentUrl);

                }else{
                    echo $response;
                }
            }




        }
    }



    // payment gateway
    public function success(Request $request){
        $data =[
            'user_id'         => auth::id(),
            'order_id'        => rand(10000,900000),
            'c_name'          => $request->cus_name,
            'c_phone'         => $request->cus_phone,
            'c_address'       => $request->opt_c,
            'c_email'         => $request->cus_email,
            'c_country'       => $request->opt_a,
            'c_city'          => $request->opt_b,
            'c_zipcode'       => $request->c_zipcode,
            'payment_type'    => $request->opt_d,
            'tax'             => 0,
            'shipping_charge' => 0,
            'status'          => 1,
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

        Mail::to(Auth::user()->email)->send(new InvoiceMail($data));


        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $message = array('message'=>'Order Successful Complete','alert-type'=>'success');
        return redirect()->route('customer.dashboard')->with($message);
    }

    public function fail(Request $request){
        return $request;
    }

    public function cancel(){
        return redirect()->to('/');
    }






}
